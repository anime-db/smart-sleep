<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Tests;

use AnimeDb\SmartSleep\Schedule;
use AnimeDb\SmartSleep\SmartSleep;
use AnimeDb\SmartSleep\Rule\RuleInterface;

class SmartSleepTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Schedule
     */
    protected $schedule;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|RuleInterface
     */
    protected $rule;

    /**
     * @var SmartSleep
     */
    protected $smart_sleep;

    /**
     * @var \DateTime
     */
    protected $time;

    protected function setUp()
    {
        $this->time = new \DateTime();
        $this->rule = $this->getMock('AnimeDb\SmartSleep\Rule\RuleInterface');
        $this->schedule = $this->getMock('AnimeDb\SmartSleep\Schedule');

        $this->smart_sleep = new SmartSleep($this->schedule);
    }

    public function testGetSleepSecondsNoMatches()
    {
        $this->schedule
            ->expects($this->once())
            ->method('getMatchedRule')
            ->with($this->time)
            ->will($this->returnValue(null));

        $this->assertEquals(0, $this->smart_sleep->getSleepSeconds($this->time));
    }

    public function testGetSleepSecondsBadSeconds()
    {
        $this->schedule
            ->expects($this->once())
            ->method('getMatchedRule')
            ->with($this->time)
            ->will($this->returnValue($this->rule));

        $this->rule
            ->expects($this->once())
            ->method('getSeconds')
            ->will($this->returnValue(-1));

        $this->assertEquals(0, $this->smart_sleep->getSleepSeconds($this->time));
    }

    public function testGetSleepSeconds()
    {
        $this->schedule
            ->expects($this->once())
            ->method('getMatchedRule')
            ->with($this->time)
            ->will($this->returnValue($this->rule));

        $this->rule
            ->expects($this->once())
            ->method('getSeconds')
            ->will($this->returnValue(10));

        $this->assertEquals(10, $this->smart_sleep->getSleepSeconds($this->time));
    }
}
