<?php

namespace UrlRunner\Model;

use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use UrlRunner\Entity\Job;
use UrlRunner\Entity\Run;

class Runner
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->$em = $em;
    }

    public function runJob(Job $job)
    {
        $run = new Run();
        $run->setJob($job);
        $this->em->persist($run);

        $client = new Client();

        $promise = $client->postAsync(
            $job->getUrl(),
            ['json' => ['key' => $job->getPostKey()]]
        );
        $promise->then(function (Response $response) use ($run) {
            $this->handleRunResponse($response, $run);
            echo 'Got a response! ' . $response->getStatusCode();
        });

        //Mark request as running
        $run->setRequestTime(new \DateTime());
        $job->setRunning(true);
        $this->em->flush([$job, $run]);
    }

    protected function handleRunResponse(Response $response, Run $run)
    {
        $run->setResponseStatusCode($response->getStatusCode());
        $run->setResponseBody((string)$response->getBody());
        $run->setResponseTime(new \DateTime());
        $job = $run->getJob();
        $job->incrementNextRunTimeToFuture();
        $job->setRunning(false);
        $this->em->flush([$job, $run]);
    }

    public function getJobsThatNeedToRun()
    {
        $query = $this->em->createQuery('
            select j
            from UrlRunner\Entity\Job j
            where j.active = true
            and j.running = false
            and j.nextRunTime => now()
        ');
        return $query->getResult();
    }
}