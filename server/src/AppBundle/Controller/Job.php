<?php

namespace UrlCron\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Job
{
    /**
     * @return \Doctrine\ORM\EntityManager
     * @TODO remove me for speed later
     */
    public function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

    public function ensureCanAccessAccount($accountId)
    {
        die('ensureAccountLoggedIn not implemented');
    }

    public function getList($accountId)
    {
        $this->ensureCanAccessAccount($accountId);

        $query = $this->getEm()->createQuery('
            select j
            from UrlCron\Entity\Job j
            join account a
            where a.accountId = :accountId
        ');
        $query->setParameter('accountId', (int)$accountId);
        /**
         * @var $job \UrlCron\Entity\Job
         */
        $jobs = $query->getResult();
        if (empty($jobs)) {
            return json_encode(['message' => 'Not Found'], 404);
        }
        $restJobs = [];
        foreach ($jobs as $job) {
            $restJobs[] = $job->getRestRes();
        }
        return json_encode($restJobs);
    }

    public function get($accountId, $jobId)
    {
        $this->ensureCanAccessAccount($accountId);

        $query = $this->getEm()->createQuery('
            select j
            from UrlCron\Entity\Job j
            join account a
            where j.jobId = :jobId
            and a.accountId = :accountId
        ');
        $query->setParameter('jobId', (int)$jobId);
        $query->setParameter('accountId', (int)$accountId);
        /**
         * @var $job \UrlCron\Entity\Job
         */
        $job = $query->getResult()[0];
        if (empty($job)) {
            return json_encode(['message' => 'Not Found'], 404);
        }
        return json_encode($job->getRestRes());
    }
}