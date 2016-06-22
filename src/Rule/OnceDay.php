<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Rule;

class OnceDay extends RuleBase
{
    /**
     * @var \DateTime
     */
    protected $time;

    public function __construct()
    {
        $this->time = new \DateTime();
    }

    /**
     * @param \DateTime $time
     *
     * @return bool
     */
    public function isMatched(\DateTime $time)
    {
        $this->time = clone $time;

        return true;
    }

    /**
     * @return int
     */
    public function getSeconds()
    {
        $next_day = clone $this->time;
        $next_day->setTime(0, 0, 0)->modify('+1 day');
        $offset = $next_day->getTimestamp() - $this->time->getTimestamp(); // offset to next day
        return $offset + rand(0, 86400); // 86400 is a 1 day
    }
}
