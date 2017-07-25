<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit;

use AnimeDb\SmartSleep\Rule\Rule;
use AnimeDb\SmartSleep\RuleCollection;
use AnimeDb\SmartSleep\ScheduleBuilder;

class ScheduleBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|RuleCollection
     */
    protected $collection;

    /**
     * @var ScheduleBuilder
     */
    protected $builder;

    protected function setUp()
    {
        $this->collection = $this->getMock('AnimeDb\SmartSleep\RuleCollection');

        $this->builder = new ScheduleBuilder($this->collection);
    }

    public function testBuildRuleFailed()
    {
        $name = 'foo';
        $this->collection
            ->expects($this->once())
            ->method('has')
            ->with($name)
            ->will($this->returnValue(false));

        $this->assertNull($this->builder->buildRule($name, 1, 2, 10));
    }

    public function testBuildRule()
    {
        $name = 'foo';
        $start = 1;
        $end = 2;
        $seconds = 10;

        /* @var $rule \PHPUnit_Framework_MockObject_MockObject|Rule */
        $rule = $this->getMock('AnimeDb\SmartSleep\Rule\RuleInterface');
        $this->buildRule($rule, $start, $end, $seconds);

        $this->collection
            ->expects($this->once())
            ->method('has')
            ->with($name)
            ->will($this->returnValue(true));

        $this->collection
            ->expects($this->once())
            ->method('get')
            ->with($name)
            ->will($this->returnValue($rule));

        $this->assertEquals($rule, $this->builder->buildRule($name, $start, $end, $seconds));
    }

    public function testBuildSchedule()
    {
        $schedule = [
            ['rule' => 'foo', 'start' => 1, 'end' => 2, 'seconds' => 10, 'exists' => true],
            ['rule' => 'bar', 'start' => 2, 'end' => 5, 'seconds' => 100, 'exists' => false],
            ['rule' => 'baz', 'start' => 5, 'end' => 10, 'seconds' => 500, 'exists' => true],
        ];

        $rules = [];
        $i = 0;
        foreach ($schedule as $key => $options) {
            if ($options['exists']) {
                /* @var $rule \PHPUnit_Framework_MockObject_MockObject|Rule */
                $rule = $this->getMock('AnimeDb\SmartSleep\Rule\RuleInterface');
                $this->buildRule($rule, $options['start'], $options['end'], $options['seconds']);

                $this->collection
                    ->expects($this->at($i++))
                    ->method('has')
                    ->with($options['rule'])
                    ->will($this->returnValue(true));

                $this->collection
                    ->expects($this->at($i++))
                    ->method('get')
                    ->with($options['rule'])
                    ->will($this->returnValue($rule));

                $rules[] = $rule;
            } else {
                $this->collection
                    ->expects($this->at($i++))
                    ->method('has')
                    ->with($options['rule'])
                    ->will($this->returnValue(false));
            }

            unset($schedule[$key]['exists']);
        }

        $schedule_obj = $this->builder->buildSchedule($schedule);

        $this->assertInstanceOf('AnimeDb\SmartSleep\Schedule', $schedule_obj);
        $this->assertEquals($rules, $schedule_obj->toArray());
    }

    /**
     * @param \PHPUnit_Framework_MockObject_MockObject $rule
     * @param int $start
     * @param int $end
     * @param int $seconds
     */
    protected function buildRule(\PHPUnit_Framework_MockObject_MockObject $rule, $start, $end, $seconds)
    {
        $rule
            ->expects($this->once())
            ->method('setEnd')
            ->with($end)
            ->will($this->returnSelf());
        $rule
            ->expects($this->once())
            ->method('setStart')
            ->with($start)
            ->will($this->returnSelf());
        $rule
            ->expects($this->once())
            ->method('setSeconds')
            ->with($seconds)
            ->will($this->returnSelf());
    }
}
