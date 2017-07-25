<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\WeekdayRule;

class WeekdayRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getMatches()
    {
        return [
            // test by day time
            [new \DateTimeImmutable('23-06-2016 2:59'), 3, 5, 10, false],
            [new \DateTimeImmutable('23-06-2016 3:00'), 3, 5, 25, true],
            [new \DateTimeImmutable('23-06-2016 4:00'), 3, 5, 33, true],
            [new \DateTimeImmutable('23-06-2016 4:59'), 3, 5, 0, true],
            [new \DateTimeImmutable('23-06-2016 5:00'), 3, 5, 67, false],
            // tests by week day
            [new \DateTimeImmutable('20-06-2016 4:00'), 3, 5, 100, true],
            [new \DateTimeImmutable('21-06-2016 4:00'), 3, 5, 150, true],
            [new \DateTimeImmutable('22-06-2016 4:00'), 3, 5, 350, true],
            [new \DateTimeImmutable('24-06-2016 4:00'), 3, 5, 550, true],
            [new \DateTimeImmutable('25-06-2016 4:00'), 3, 5, 123, false],
            [new \DateTimeImmutable('26-06-2016 4:00'), 3, 5, 999, false],
        ];
    }

    /**
     * @dataProvider getMatches
     *
     * @param \DateTimeImmutable $time
     * @param int $start
     * @param int $end
     * @param int $seconds
     * @param bool $match
     */
    public function testIsMatched(\DateTimeImmutable $time, $start, $end, $seconds, $match)
    {
        $rule = new WeekdayRule($start, $end, $seconds);

        $this->assertEquals($start, $rule->start());
        $this->assertEquals($end, $rule->end());
        $this->assertGreaterThanOrEqual(0, $seconds);
        $this->assertLessThanOrEqual($seconds, $rule->seconds());

        if ($match) {
            $this->assertTrue($rule->isMatched($time));
        } else {
            $this->assertFalse($rule->isMatched($time));
        }
    }
}
