<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Tests\Unit;

use AnimeDb\SmartSleep\Rule\Rule;
use AnimeDb\SmartSleep\RuleCollection;

class RuleCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RuleCollection
     */
    protected $collection;

    protected function setUp()
    {
        $this->collection = new RuleCollection();
    }

    public function testGetSet()
    {
        $this->assertFalse($this->collection->has('foo'));
        $this->assertNull($this->collection->get('foo'));

        /* @var $rule \PHPUnit_Framework_MockObject_MockObject|Rule */
        $rule = $this->getMock('AnimeDb\SmartSleep\Rule\RuleInterface');

        $this->assertEquals($this->collection, $this->collection->set('foo', $rule));
        $this->assertTrue($this->collection->has('foo'));
        $this->assertEquals($rule, $this->collection->get('foo'));
    }

    public function testSetClone()
    {
        $rule = new TestRule();
        $this->collection->set('foo', $rule);

        $rule->setSeconds(123);
        $this->assertNotEquals($rule, $this->collection->get('foo'));
    }

    public function testGetClone()
    {
        $rule = new TestRule();
        $this->collection->set('foo', $rule);

        $collection_rule = $this->collection->get('foo');
        $collection_rule->setSeconds(123);
        $this->assertNotEquals($collection_rule, $this->collection->get('foo'));
    }
}
