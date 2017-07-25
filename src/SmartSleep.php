<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep;

use AnimeDb\SmartSleep\Rule\Rule;

class SmartSleep
{
    /**
     * @var Schedule
     */
    private $schedule = [];

    /**
     * @param Schedule $schedule
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @param \DateTimeImmutable $now
     *
     * @return int
     */
    public function sleepForSeconds(\DateTimeImmutable $now)
    {
        $rule = $this->schedule->matchedRule($now);
        if ($rule instanceof Rule) {
            $seconds = $rule->seconds();

            return $seconds > 0 ? $seconds : 0;
        }

        return 0;
    }
}
