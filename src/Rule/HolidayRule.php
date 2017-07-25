<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

class HolidayRule implements HourIntervalRule
{
    use HourIntervalRuleTrait;
    use RandMaxSecondsRuleTrait;

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
        return
            $time->format('N') > 5 &&
            $this->start() <= $time->format('G') &&
            $this->end() > $time->format('G')
        ;
    }
}
