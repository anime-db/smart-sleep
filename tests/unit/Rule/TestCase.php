<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Tests\Unit\Rule;

use AnimeDb\SmartSleep\Rule\RuleInterface;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @return RuleInterface
     */
    abstract function getRule();

    /**
     * @return array
     */
    public function getGettersAndSetters()
    {
        return [
            ['getStart', 'setStart', -1],
            ['getEnd', 'setEnd', -1],
            ['getSeconds', 'setSeconds', 0],
        ];
    }

    /**
     * @dataProvider getGettersAndSetters
     *
     * @param string $getter
     * @param string $setter
     * @param int $new_value
     * @param int $default_value
     */
    public function testGetSet($getter, $setter, $default_value, $new_value = 123)
    {
        $this->assertEquals($default_value, call_user_func([$this->getRule(), $getter]));
        $this->assertEquals($this->getRule(), call_user_func([$this->getRule(), $setter], $new_value));
        $this->assertEquals($new_value, call_user_func([$this->getRule(), $getter]));
    }
}
