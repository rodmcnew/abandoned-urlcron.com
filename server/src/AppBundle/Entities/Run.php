<?php

namespace UrlRunner\Entity;

/**
 * Class Request
 *
 * Represents a single "run" of a job. Contains info about the run's request and
 * response
 *
 * @ORM\Entity
 * @ORM\Table(name="run")
 */
class Run
{
    /**
     * @var int Auto-Incremented Primary Key
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @var Job
     *
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="runs")
     * @ORM\JoinColumn(name="jobId", referencedColumnName="id")
     **/
    protected $job;
    /**
     * @var \DateTime time the last request was submitted
     *
     * @ORM\Column(type="datetime")
     */
    protected $requestTime;
    /**
     * @var \DateTime time the last request was submitted
     *
     * @ORM\Column(type="datetime")
     */
    protected $responseTime;
    /**
     * @var int the response http code
     *
     * @ORM\Column(type="int")
     */
    protected $responseStatusCode;
    /**
     * @var string the text body from the response
     *
     * @ORM\Column(type="text")
     */
    protected $responseBody;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getRequestTime()
    {
        return $this->requestTime;
    }

    /**
     * @param \DateTime $requestTime
     */
    public function setRequestTime($requestTime)
    {
        $this->requestTime = $requestTime;
    }

    /**
     * @return \DateTime
     */
    public function getResponseTime()
    {
        return $this->responseTime;
    }

    /**
     * @param \DateTime $responseTime
     */
    public function setResponseTime($responseTime)
    {
        $this->responseTime = $responseTime;
    }

    /**
     * @return int
     */
    public function getResponseStatusCode()
    {
        return $this->responseStatusCode;
    }

    /**
     * @param int $responseStatusCode
     */
    public function setResponseStatusCode($responseStatusCode)
    {
        $this->responseStatusCode = $responseStatusCode;
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @param string $responseBody
     */
    public function setResponseBody($responseBody)
    {
        $this->responseBody = $responseBody;
    }

    /**
     * @return Job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param Job $job
     */
    public function setJob($job)
    {
        $this->job = $job;
    }

}