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
     * @var RuleCollection
     */
    protected $collection;

    /**
     * @param RuleCollection $collection
     */
    public function __construct(RuleCollection $collection)
    {
        $this->collection = $collection;
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
        if (!$this->collection->has($name)) {
            return null;
        }

        return $this
            ->collection
            ->get($name)
            ->setEnd($end)
            ->setStart($start)
            ->setSeconds($seconds);
    }

    /**
     * Build schedule.
     *
     * <code>
     * [
     *   {rule: <rule_name>, start: <start_hour>, end: <end_hour>, seconds: <sleep_seconds>},
     *   ...
     * ]
     * </code>
     *
     * @param array $schedule
     *
     * @return Schedule
     */
    public function buildSchedule(array $schedule)
    {
        $result = new Schedule();
        foreach ($schedule as $options) {
            $rule = $this->buildRule($options['rule'], $options['start'], $options['end'], $options['seconds']);

            if ($rule instanceof RuleInterface) {
                $result->add($rule);
            }
        }

        return $result;
    }
}
