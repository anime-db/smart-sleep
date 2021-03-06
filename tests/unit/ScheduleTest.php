<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit;

use AnimeDb\SmartSleep\Rule\Rule;
use AnimeDb\SmartSleep\Schedule;

class ScheduleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Schedule
     */
    private $schedule;

    protected function setUp()
    {
        $this->schedule = new Schedule();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(\IteratorAggregate::class, $this->schedule);
        $this->assertInstanceOf(\Countable::class, $this->schedule);
    }

    public function testConstruct()
    {
        /* @var $rules \PHPUnit_Framework_MockObject_MockObject[]|Rule[] */
        $rules = [
            $this->getMock(Rule::class),
            $this->getMock(Rule::class),
            $this->getMock(Rule::class),
        ];

        $schedule = new Schedule($rules);

        $this->assertEquals($rules, $schedule->toArray());
        $this->assertEquals(count($rules), $schedule->count());
        $this->assertFalse($schedule->isEmpty());
        $this->assertEquals(new \ArrayIterator($rules), $schedule->getIterator());
    }

    public function testAdd()
    {
        $this->assertEquals([], $this->schedule->toArray());
        $this->assertEquals(0, $this->schedule->count());
        $this->assertTrue($this->schedule->isEmpty());

        /* @var $rule1 \PHPUnit_Framework_MockObject_MockObject|Rule */
        $rule1 = $this->getMock(Rule::class);
        $this->schedule->add($rule1);

        $this->assertEquals([$rule1], $this->schedule->toArray());
        $this->assertEquals(1, $this->schedule->count());
        $this->assertFalse($this->schedule->isEmpty());

        /* @var $rule2 \PHPUnit_Framework_MockObject_MockObject|Rule */
        $rule2 = $this->getMock(Rule::class);
        $this->schedule->add($rule2);

        $this->assertEquals([$rule1, $rule2], $this->schedule->toArray());
        $this->assertEquals(2, $this->schedule->count());
        $this->assertEquals(new \ArrayIterator([$rule1, $rule2]), $this->schedule->getIterator());
    }

    /**
     * @return array
     */
    public function getMatchedRule()
    {
        return [
            [2, 0], // not matched
            [3, 1], // first matched
            [3, 3], // last matched
        ];
    }

    /**
     * @dataProvider getMatchedRule
     *
     * @param int $count_rules
     * @param int $match_rule_number
     */
    public function testGetMatchedRule($count_rules, $match_rule_number)
    {
        $time = new \DateTimeImmutable();
        $match_rule = null;

        for ($i = 1; $i <= $count_rules; ++$i) {
            /* @var $rule \PHPUnit_Framework_MockObject_MockObject|Rule */
            $rule = $this->getMock(Rule::class);
            if ($match_rule_number && $i > $match_rule_number) {
                $rule
                    ->expects($this->never())
                    ->method('isMatched');
            } else {
                $rule
                    ->expects($this->once())
                    ->method('isMatched')
                    ->with($time)
                    ->will($this->returnValue($i == $match_rule_number));
                if ($i == $match_rule_number) {
                    $match_rule = $rule;
                }
            }

            $this->schedule->add($rule);
        }

        $this->assertEquals($match_rule, $this->schedule->matchedRule($time));
    }
}
