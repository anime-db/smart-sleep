<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep;

use AnimeDb\SmartSleep\Rule\RuleInterface;

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
     * @param \DateTime|null $now
     * @param Schedule|null $schedule
     *
     * @return int
     */
    public function getSleepSeconds(\DateTime $now = null, Schedule $schedule = null)
    {
        $schedule = $schedule ?: $this->schedule;
        $now = $now ?: new \DateTime();

        $rule = $schedule->getMatchedRule($now);
        if ($rule instanceof RuleInterface) {
            $seconds = $rule->getSeconds();

            return $seconds > 0 ? $seconds : 0;
        }

        return 0;
    }
}
