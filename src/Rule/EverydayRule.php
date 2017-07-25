<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

class EverydayRule implements HourIntervalRule
{
    use HourlyIntervalRuleTrait;
    use RandSecondsRuleTrait;

    /**
     * @param int $start
     * @param int $end
     * @param int $seconds
     */
    public function __construct($start, $end, $seconds)
    {
        $this->setStart($start);
        $this->setEnd($end);
        $this->setSeconds($seconds);
    }

    /**
     * @param \DateTime $time
     *
     * @return bool
     */
    public function isMatched(\DateTime $time)
    {
        return $this->start() <= $time->format('G') && $this->end() > $time->format('G');
    }
}
