<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit;

use AnimeDb\SmartSleep\Schedule;
use AnimeDb\SmartSleep\SmartSleep;
use AnimeDb\SmartSleep\Rule\Rule;

class SmartSleepTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Schedule
     */
    private $schedule;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Rule
     */
    private $rule;

    /**
     * @var SmartSleep
     */
    private $smart_sleep;

    /**
     * @var \DateTimeImmutable
     */
    private $time;

    protected function setUp()
    {
        $this->time = new \DateTimeImmutable();
        $this->rule = $this->getMock(Rule::class);
        $this->schedule = $this->getMock(Schedule::class);

        $this->smart_sleep = new SmartSleep($this->schedule);
    }

    public function testGetSleepSecondsNoMatches()
    {
        $this->schedule
            ->expects($this->once())
            ->method('matchedRule')
            ->with($this->time)
            ->will($this->returnValue(null))
        ;

        $this->assertEquals(0, $this->smart_sleep->sleepForSeconds($this->time));
    }

    public function testGetSleepSecondsBadSeconds()
    {
        $this->schedule
            ->expects($this->once())
            ->method('matchedRule')
            ->with($this->time)
            ->will($this->returnValue($this->rule))
        ;

        $this->rule
            ->expects($this->once())
            ->method('seconds')
            ->will($this->returnValue(-1))
        ;

        $this->assertEquals(0, $this->smart_sleep->sleepForSeconds($this->time));
    }

    public function testGetSleepSeconds()
    {
        $this->schedule
            ->expects($this->once())
            ->method('matchedRule')
            ->with($this->time)
            ->will($this->returnValue($this->rule))
        ;

        $this->rule
            ->expects($this->once())
            ->method('seconds')
            ->will($this->returnValue(10))
        ;

        $this->assertEquals(10, $this->smart_sleep->sleepForSeconds($this->time));
    }
}
