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
        $this->time = new \DateTimeImmutable(); // default time
    }

    /**
     * @param \DateTimeImmutable $time
     *
     * @return bool
     */
    public function isMatched(\DateTimeImmutable $time)
    {
        $this->time = $time; // save current time

        return true;
    }

    /**
     * @return int
     */
    public function seconds()
    {
        $offset_time = $this->time->modify('+1 week')->setTime(0, 0, 0);
        $offset = $offset_time->getTimestamp() - $this->time->getTimestamp(); // offset to next week

        return $offset + rand(0, 604800); // 604800 is a 1 week
    }
}
