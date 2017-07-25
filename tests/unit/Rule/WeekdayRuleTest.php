<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\WeekdayRule;

class WeekdayRuleTest extends RandMaxSecondsTestCase
{
    /**
     * @var WeekdayRule
     */
    protected $rule;

    /**
     * @var WeekdayRule
     */
    protected $rule_limited;

    protected function setUp()
    {
        $this->rule = new WeekdayRule();
    }

    /**
     * @return WeekdayRule
     */
    protected function getRule()
    {
        return $this->rule;
    }

    /**
     * @param int $min_sleep_seconds
     *
     * @return WeekdayRule
     */
    protected function getRuleForMinSleepSeconds($min_sleep_seconds)
    {
        if (!$this->rule_limited) {
            $this->rule_limited = new WeekdayRule($min_sleep_seconds);
        }

        return $this->rule_limited;
    }

    /**
     * @return array
     */
    public function getMatches()
    {
        return [
            // test by day time
            [new \DateTime('23-06-2016 2:59'), 3, 5, false],
            [new \DateTime('23-06-2016 3:00'), 3, 5, true],
            [new \DateTime('23-06-2016 4:00'), 3, 5, true],
            [new \DateTime('23-06-2016 4:59'), 3, 5, true],
            [new \DateTime('23-06-2016 5:00'), 3, 5, false],
            // tests by week day
            [new \DateTime('20-06-2016 4:00'), 3, 5, true],
            [new \DateTime('21-06-2016 4:00'), 3, 5, true],
            [new \DateTime('22-06-2016 4:00'), 3, 5, true],
            [new \DateTime('24-06-2016 4:00'), 3, 5, true],
            [new \DateTime('25-06-2016 4:00'), 3, 5, false],
            [new \DateTime('26-06-2016 4:00'), 3, 5, false],
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
