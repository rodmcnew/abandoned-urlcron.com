<?php

namespace UrlRunner\Entity;

/**
 * Class Job
 *
 * @ORM\Entity
 * @ORM\Table(name="job",
 *     indexes={
 *         @ORM\Index(name="active_running_nextRunTime", columns={"active","running","nextRunTime"})
 *     }
 * )
 */
class Job
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
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="jobs")
     * @ORM\JoinColumn(name="accountId", referencedColumnName="id")
     **/
    protected $account;
    /**
     * @var string job name as defined by user
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    /**
     * @var string job url as defined by user
     *
     * @ORM\Column(type="string", length=2000)
     */
    protected $url;
    /**
     * @var int number of minutes between job runs
     *
     * @ORM\Column(type="int")
     */
    protected $runInterval;
    /**
     * @var boolean true if job is enabled and should run
     *
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @return \DateTime
     */
    public function getLastRunTime()
    {
        return $this->lastRunTime;
    }

    /**
     * @param \DateTime $lastRunTime
     */
    public function setLastRunTime($lastRunTime)
    {
        $this->lastRunTime = $lastRunTime;
    }

    /**
     * @var \DateTime The next time the job should run
     *
     * @ORM\Column(type="datetime")
     */
    protected $nextRunTime;
    /**
     * @var \DateTime The last time the job ran
     *
     * @ORM\Column(type="datetime")
     */
    protected $lastRunTime;
    /**
     * @var boolean true if job should run
     *
     * @ORM\Column(type="boolean")
     */
    protected $running;
    /**
     * @var array Array of runs
     *
     * @ORM\OneToMany(targetEntity="Run",mappedBy="job")
     */
    protected $runs;

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
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getRunInterval()
    {
        return $this->runInterval;
    }

    /**
     * @param int $runInterval
     */
    public function setRunInterval($runInterval)
    {
        $this->runInterval = $runInterval;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return \DateTime
     */
    public function getFirstRunTime()
    {
        return $this->firstRunTime;
    }

    /**
     * @param \DateTime $firstRunTime
     */
    public function setFirstRunTime($firstRunTime)
    {
        $this->firstRunTime = $firstRunTime;
    }

    /**
     * @return \DateTime
     */
    public function getNextRunTime()
    {
        return $this->nextRunTime;
    }

    /**
     * @param \DateTime $nextRunTime
     */
    public function setNextRunTime($nextRunTime)
    {
        $this->nextRunTime = $nextRunTime;
    }

    /**
     * @return boolean
     */
    public function isRunning()
    {
        return $this->running;
    }

    /**
     * @param boolean $running
     */
    public function setRunning($running)
    {
        $this->running = $running;
    }

    /**
     * Increments the next run time, putting in in the first future date
     * that is the start run time + n intervals
     */
    public function incrementNextRunTimeToFuture()
    {
        $now = new \DateTime();
        $runInterval = new\DateInterval('PT' . $this->getRunInterval() . 'M');
        while ($this->nextRunTime <= $now) {
            $this->nextRunTime->add($runInterval);
        }
    }

    public function getRestRes()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'runInterval' => $this->runInterval,
            'nextRunTime' => $this->nextRunTime,
            'lastRunTime' => $this->lastRunTime,
            'active' => $this->active,
        ];
    }
}