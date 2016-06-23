<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\RandMaxSecondsRuleBase;
use AnimeDb\SmartSleep\Rule\RuleInterface;

abstract class RandMaxSecondsTestCase extends TestCase
{
    /**
     * Create rule and set min sleep seconds to construct.
     *
     * @param int $min_sleep_seconds
     *
     * @return RuleInterface
     */
    abstract function getRuleForMinSleepSeconds($min_sleep_seconds);

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

    /**
     * @return array
     */
    public function getRandSeconds()
    {
        return [
            [true],
            [false],
        ];
    }

    /**
     * @dataProvider getRandSeconds
     *
     * @param bool $default
     */
    public function testRandSeconds($default)
    {
        if ($default) {
            $min = RandMaxSecondsRuleBase::DEFAULT_MIN_SLEEP_SECONDS;
            $rule = $this->getRule();
        } else {
            $min = 4;
            $rule = $this->getRuleForMinSleepSeconds($min);
        }
        $max = $min + 1;

        $this->assertEquals($rule, $rule->setSeconds($max));
        $seconds = $rule->getSeconds();
        $this->assertTrue($seconds == $min || $seconds == $max);
    }
}
