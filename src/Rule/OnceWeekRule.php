<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Rule;

class OnceWeekRule extends RuleBase
{
    /**
     * @var \DateTime
     */
    protected $time;

    public function __construct()
    {
        $this->time = new \DateTime(); // default time
    }

    /**
     * @param \DateTime $time
     *
     * @return bool
     */
    public function isMatched(\DateTime $time)
    {
        $this->time = clone $time; // save current time

        return true;
    }

    /**
     * @return int
     */
    public function getSeconds()
    {
        $offset_time = clone $this->time;
        $offset_time->setTime(0, 0, 0)->modify('+1 week');
        $offset = $offset_time->getTimestamp() - $this->time->getTimestamp(); // offset to next week

        return $offset + rand(0, 604800); // 604800 is a 1 week
    }
}
