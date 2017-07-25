<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

class OnceDayRule extends RuleBase
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
        $offset_time->modify('+1 day 00:00:00');
        $offset = $offset_time->getTimestamp() - $this->time->getTimestamp(); // offset to next day

        return $offset + rand(0, 86400); // 86400 is a 1 day
    }
}
