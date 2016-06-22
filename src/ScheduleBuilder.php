<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep;

use AnimeDb\SmartSleep\Rule\RuleInterface;

class ScheduleBuilder
{
    /**
     * @var Chain
     */
    protected $chain;

    /**
     * @param Chain $chain
     */
    public function __construct(Chain $chain)
    {
        $this->chain = $chain;
    }

    /**
     * @param string $name
     * @param int $start
     * @param int $end
     * @param int $seconds
     *
     * @return RuleInterface|null
     */
    public function buildRule($name, $start, $end, $seconds)
    {
        if (!$this->chain->hasRule($name)) {
            return null;
        }

        return $this
            ->chain
            ->getRule($name)
            ->setEnd($end)
            ->setSeconds($seconds)
            ->setStart($start);
    }

    /**
     * Build schedule.
     *
     * <code>
     * [
     *   {rule: <rule_name>, start: <start_hour>, start: <end_hour>, seconds: <sleep_seconds>},
     *   ...
     * ]
     * </code>
     *
     * @param array $schedule
     *
     * @return RuleInterface[]
     */
    public function buildSchedule(array $schedule)
    {
        $result = [];
        foreach ($schedule as $rule) {
            $rule = $this->buildRule($rule['rule'], $rule['start'], $rule['end'], $rule['seconds']);

            if ($rule) {
                $result[] = $rule;
            }
        }

        return $result;
    }
}
