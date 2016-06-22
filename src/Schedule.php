<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep;

use AnimeDb\SmartSleep\Rule\RuleInterface;

class Schedule implements \IteratorAggregate, \Countable
{
    /**
     * @var RuleInterface[]
     */
    protected $rules = [];

    /**
     * @param RuleInterface[] $rules
     */
    public function __construct(array $rules = [])
    {
        foreach ($rules as $rule) {
            $this->add($rule);
        }
    }

    /**
     * @param RuleInterface $rule
     *
     * @return true
     */
    public function add(RuleInterface $rule)
    {
        $this->rules[] = $rule;

        return true;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->rules);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->rules);
    }

    /**
     * @return RuleInterface[]
     */
    public function toArray()
    {
        return $this->rules;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->rules);
    }

    /**
     * @param \DateTime $time
     *
     * @return RuleInterface|null
     */
    public function getMatchedRule(\DateTime $time)
    {
        foreach ($this->rules as $rule) {
            if ($rule->isMatched($time)) {
                return $rule;
            }
        }

        return null;
    }
}
