<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\SpecificDayRule;

class SpecificDayRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getMatches()
    {
        return [
            // in current day
            [new \DateTimeImmutable('2:59'), new \DateTimeImmutable(), 3, 5, 10, false],
            [new \DateTimeImmutable('3:00'), new \DateTimeImmutable(), 3, 5, 50, true],
            [new \DateTimeImmutable('4:00'), new \DateTimeImmutable(), 3, 5, 100, true],
            [new \DateTimeImmutable('4:59'), new \DateTimeImmutable(), 3, 5, 200, true],
            [new \DateTimeImmutable('5:00'), new \DateTimeImmutable(), 3, 5, 550, false],
            // in New Year
            [new \DateTimeImmutable('2016-12-31 4:00'), new \DateTimeImmutable('2017-01-01'), 0, 10, 500, false],
            [new \DateTimeImmutable('2017-01-02 4:00'), new \DateTimeImmutable('2017-01-01'), 0, 10, 500, false],
        ];
    }

    /**
     * @dataProvider getMatches
     *
     * @param \DateTimeImmutable $time
     * @param \DateTimeImmutable $day
     * @param int $start
     * @param int $end
     * @param int $seconds
     * @param bool $match
     */
    public function testIsMatched(\DateTimeImmutable $time, \DateTimeImmutable $day, $start, $end, $seconds, $match)
    {
        $rule = new SpecificDayRule($day, $start, $end, $seconds);

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
