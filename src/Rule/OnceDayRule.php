<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

class OnceDayRule implements Rule
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
        $offset_time = $this->time;
        $offset_time->modify('+1 day')->setTime(0, 0, 0);
        $offset = $offset_time->getTimestamp() - $this->time->getTimestamp(); // offset to next day

        return $offset + rand(0, 86400); // 86400 is a 1 day
    }
}
