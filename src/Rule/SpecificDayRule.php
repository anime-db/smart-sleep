<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

class SpecificDayRule implements HourIntervalRule
{
    use HourlyIntervalRuleTrait;
    use RandSecondsRuleTrait;

    /**
     * @var \DateTimeImmutable
     */
    private $day;

    /**
     * @param \DateTimeImmutable $day
     * @param int $start
     * @param int $end
     * @param int $seconds
     */
    public function __construct(\DateTimeImmutable $day, $start, $end, $seconds)
    {
        $this->day = $day;
        $this->setStart($start);
        $this->setEnd($end);
        $this->setSeconds($seconds);
    }

    /**
     * @param \DateTimeImmutable $time
     *
     * @return bool
     */
    public function isMatched(\DateTimeImmutable $time)
    {
        return
            $this->day->format('Ymd') == $time->format('Ymd') &&
            $this->start() <= $time->format('G') &&
            $this->end() > $time->format('G')
        ;
    }
}
