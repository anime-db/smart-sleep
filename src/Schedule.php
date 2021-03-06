<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep;

use AnimeDb\SmartSleep\Rule\Rule;

class Schedule implements \IteratorAggregate, \Countable
{
    /**
     * @var Rule[]
     */
    private $rules = [];

    /**
     * @param Rule[] $rules
     */
    public function __construct(array $rules = [])
    {
        foreach ($rules as $rule) {
            $this->add($rule);
        }
    }

    /**
     * @param Rule $rule
     */
    public function add(Rule $rule)
    {
        $this->rules[] = $rule;
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
     * @return Rule[]
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
     * @param \DateTimeImmutable $time
     *
     * @return Rule|null
     */
    public function matchedRule(\DateTimeImmutable $time)
    {
        foreach ($this->rules as $rule) {
            if ($rule->isMatched($time)) {
                return $rule;
            }
        }

        return null;
    }
}
