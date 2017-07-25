<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\EverydayRule;

class EverydayRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getMatches()
    {
        return [
            [new \DateTimeImmutable('2:59'), 3, 5, 10, false],
            [new \DateTimeImmutable('3:00'), 3, 5, 50, true],
            [new \DateTimeImmutable('4:00'), 3, 5, 100, true],
            [new \DateTimeImmutable('4:59'), 3, 5, 200, true],
            [new \DateTimeImmutable('5:00'), 3, 5, 550, false],
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
        $rule = new EverydayRule($start, $end, $seconds);

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
