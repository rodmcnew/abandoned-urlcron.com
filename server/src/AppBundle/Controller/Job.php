<?php

namespace UrlRunner\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Job
{
    public function ensureAccountLoggedIn($accountId)
    {
        die('ensureAccountLoggedIn not implemented');
    }

    public function get(Request $request, Application $app, $accountId, $jobId)
    {
        $this->ensureAccountLoggedIn($accountId);
        /*
         * @var $em Doctrine\ORM\EntityManager
         */
        $em = $app['orm.em'];
        $query = $this->em->createQuery('
            select j
            from UrlRunner\Entity\Job j
            join account a
            where j.jobId = :jobId
            and a.accountId = :accountId
        ');
        $query->setParameter('jobId', (int)$jobId);
        $query->setParameter('accountId', (int)$accountId);
        /**
         * @var $job \UrlRunner\Entity\Job
         */
        $job = $query->getResult()[0];
        if (!$job) {
            return $app->json(['message' => 'Not Found'], 404);
        }

        return $app->json($job->getRestRes());
    }
}