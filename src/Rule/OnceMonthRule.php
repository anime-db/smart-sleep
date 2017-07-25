<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

class OnceMonthRule implements Rule
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
        // interval duration [next month, next month +1)
        $offset_time = clone $this->time;
        $offset_time->modify('+1 month 00:00:00')->modify('first day of this month');

        $limit_time = clone $offset_time;
        $limit_time->modify('+1 month');
        $limit = $limit_time->getTimestamp() - $offset_time->getTimestamp();

        // offset to next month
        $offset = $offset_time->getTimestamp() - $this->time->getTimestamp();

        return $offset + rand(0, $limit);
    }
}
