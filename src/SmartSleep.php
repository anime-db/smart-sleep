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
     * @var RuleInterface[]
     */
    protected $schedule = array();

    /**
     * @param RuleInterface[] $schedule
     */
    public function __construct(array $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @param \DateTime|null $now
     *
     * @return int
     */
    public function getSleepSeconds(\DateTime $now = null)
    {
        $seconds = 0;
        $now = $now ?: new \DateTime();
        foreach ($this->schedule as $rule) {
            if ($rule->isMatched($now)) {
                $seconds = $rule->getSeconds();
                break;
            }
        }

        return $seconds > 0 ? $seconds : 0;
    }
}
