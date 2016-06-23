<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Rule;

class OnceMonthRule extends RuleBase
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
        $offset_time->modify('+1 month');

        $limit_time = clone $this->time;
        $limit_time->modify('+2 month');

        // limit to later month
        $limit = $limit_time->setTime(0, 0, 0)->getTimestamp() - $offset_time->getTimestamp();
        // offset to next month
        $offset = $offset_time->setTime(0, 0, 0)->getTimestamp() - $this->time->getTimestamp();

        return $offset + rand(0, $limit);
    }
}
