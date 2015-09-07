<?php

namespace UrlCron\Entity;
/**
 * Class Account
 *
 * @ORM\Entity
 * @ORM\Table(name="account")
 */
class Account
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
     * @var array Array of jobs
     *
     * @ORM\OneToMany(targetEntity="Job",mappedBy="account")
     */
    protected $jobs;
    /**
     * @var string users email
     *
     * @ORM\Column(type="string", length=500)
     */
    protected $email;
    /**
     * @var int minimum selectable interval for this account
     *
     * @ORM\Column(type="int")
     */
    protected $minInterval;
    /**
     * @var int maximum addable jobs for this account
     *
     * @ORM\Column(type="int")
     */
    protected $maxJobs;
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
     * @return array
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param array $jobs
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getMinInterval()
    {
        return $this->minInterval;
    }

    /**
     * @param int $minInterval
     */
    public function setMinInterval($minInterval)
    {
        $this->minInterval = $minInterval;
    }
}