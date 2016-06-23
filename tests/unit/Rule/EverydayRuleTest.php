<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\EverydayRule;

class EverydayRuleTest extends RandMaxSecondsTestCase
{
    /**
     * @var EverydayRule
     */
    protected $rule;

    /**
     * @var EverydayRule
     */
    protected $rule_limited;

    protected function setUp()
    {
        $this->rule = new EverydayRule();
    }

    /**
     * @return EverydayRule
     */
    protected function getRule()
    {
        return $this->rule;
    }

    /**
     * @param int $min_sleep_seconds
     *
     * @return EverydayRule
     */
    public function getRuleForMinSleepSeconds($min_sleep_seconds)
    {
        if (!$this->rule_limited) {
            $this->rule_limited = new EverydayRule($min_sleep_seconds);
        }

        return $this->rule_limited;
    }

    /**
     * @return array
     */
    public function getMatches()
    {
        return [
            [new \DateTime('2:59'), 3, 5, false],
            [new \DateTime('3:00'), 3, 5, true],
            [new \DateTime('4:00'), 3, 5, true],
            [new \DateTime('4:59'), 3, 5, true],
            [new \DateTime('5:00'), 3, 5, false],
        ];
    }

    /**
     * @dataProvider getMatches
     *
     * @param \DateTime $time
     * @param int $start
     * @param int $end
     * @param bool $match
     */
    public function testIsMatched(\DateTime $time, $start, $end, $match)
    {
        $this->rule
            ->setStart($start)
            ->setEnd($end);

        if ($match) {
            $this->assertTrue($this->rule->isMatched($time));
        } else {
            $this->assertFalse($this->rule->isMatched($time));
        }
    }
}
