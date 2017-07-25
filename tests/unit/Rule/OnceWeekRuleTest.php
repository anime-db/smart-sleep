<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\OnceWeekRule;

class OnceWeekRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OnceWeekRule
     */
    private $rule;

    protected function setUp()
    {
        $this->rule = new OnceWeekRule();
    }

    public function testSecondsFromConstruct()
    {
        $limit = strtotime('+2 week 00:00:00') - time();

        $seconds = $this->rule->seconds();

        // -1 seconds because is long wait execute test
        $this->assertGreaterThanOrEqual(-1, $seconds);
        $this->assertLessThan($limit, $seconds);
    }

    public function testSecondsFromMatched()
    {
        $time = new \DateTimeImmutable('23-06-2016 13:42:15');
        $limit_time = new \DateTimeImmutable('07-07-2016 00:00:00');
        $limit = $limit_time->getTimestamp() - $time->getTimestamp();

        $this->rule->isMatched($time);

        $seconds = $this->rule->seconds();
        $this->assertGreaterThanOrEqual(0, $seconds);
        $this->assertLessThan($limit, $seconds);
    }
}
