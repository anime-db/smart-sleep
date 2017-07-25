<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\OnceDayRule;

class OnceDayRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OnceDayRule
     */
    private $rule;

    protected function setUp()
    {
        $this->rule = new OnceDayRule();
    }

    public function testSecondsFromConstruct()
    {
        $limit = strtotime('+2 day 00:00:00') - time();

        $seconds = $this->rule->seconds();

        // -1 seconds because is long wait execute test
        $this->assertGreaterThanOrEqual(-1, $seconds);
        $this->assertLessThan($limit, $seconds);
    }

    public function testSecondsFromMatched()
    {
        $time = new \DateTime('23-06-2016 13:42:15');

        $limit_time = new \DateTime('25-06-2016 00:00:00');
        $limit = $limit_time->getTimestamp() - $time->getTimestamp();

        $this->rule->isMatched($time);

        $seconds = $this->rule->seconds();
        $this->assertGreaterThanOrEqual(0, $seconds);
        $this->assertLessThan($limit, $seconds);
    }
}
