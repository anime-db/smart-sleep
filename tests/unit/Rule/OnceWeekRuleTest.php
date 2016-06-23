<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\OnceWeekRule;

class OnceWeekRuleTest extends TestCase
{
    /**
     * @var OnceWeekRule
     */
    protected $rule;

    protected function setUp()
    {
        $this->rule = new OnceWeekRule();
    }

    /**
     * @return OnceWeekRule
     */
    protected function getRule()
    {
        return $this->rule;
    }

    /**
     * @return array
     */
    public function getGettersAndSetters()
    {
        return [
            ['getStart', 'setStart', -1],
            ['getEnd', 'setEnd', -1],
            // not check get/set seconds
        ];
    }

    public function testSetSeconds()
    {
        // setted seconds not used
        $this->assertEquals($this->rule, $this->rule->setSeconds(123));
    }

    public function testGetSecondsFromConstruct()
    {
        $limit = strtotime('+2 week 00:00:00') - time();

        $seconds = $this->rule->getSeconds();

        // -1 seconds because is long wait execute test
        $this->assertTrue($seconds >= -1);
        $this->assertTrue($seconds < $limit);
    }

    public function testGetSecondsFromMatched()
    {
        $time = new \DateTime('23-06-2016 13:42:15');
        $limit_time = new \DateTime('07-07-2016 00:00:00');
        $limit = $limit_time->getTimestamp() - $time->getTimestamp();

        $this->rule->isMatched($time);

        $seconds = $this->rule->getSeconds();
        $this->assertTrue($seconds >= 0);
        $this->assertTrue($seconds < $limit);
    }
}
