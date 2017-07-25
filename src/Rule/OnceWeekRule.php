<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

class OnceWeekRule implements Rule
{
    /**
     * @var \DateTime
     */
    private $time;

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
    public function seconds()
    {
        $offset_time = clone $this->time;
        $offset_time->modify('+1 week 00:00:00');
        $offset = $offset_time->getTimestamp() - $this->time->getTimestamp(); // offset to next week

        return $offset + rand(0, 604800); // 604800 is a 1 week
    }
}
