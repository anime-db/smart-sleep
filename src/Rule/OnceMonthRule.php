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
        // interval duration [next month, next month +1)
        $offset_time = $this->time->modify('first day of this month')->modify('+1 month')->setTime(0, 0, 0);

        $limit_time = $offset_time->modify('+1 month');
        $limit = $limit_time->getTimestamp() - $offset_time->getTimestamp();

        // offset to next month
        $offset = $offset_time->getTimestamp() - $this->time->getTimestamp();

        return $offset + rand(0, $limit);
    }
}
