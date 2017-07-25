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
    protected $schedule = [];

    /**
     * @param Schedule $schedule
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @param \DateTime $now
     *
     * @return int
     */
    public function getSleepSeconds(\DateTime $now)
    {
        $rule = $this->schedule->getMatchedRule($now);
        if ($rule instanceof Rule) {
            $seconds = $rule->getSeconds();

            return $seconds > 0 ? $seconds : 0;
        }

        return 0;
    }
}
