<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep;

use AnimeDb\SmartSleep\Rule\RuleInterface;

class RuleCollection
{
    /**
     * @var RuleInterface[]
     */
    protected $rules = [];

    /**
     * @param string $name
     * @param RuleInterface $rule
     *
     * @return RuleCollection
     */
    public function set($name, RuleInterface $rule)
    {
        $this->rules[$name] = clone $rule;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return RuleInterface|null
     */
    public function get($name)
    {
        return isset($this->rules[$name]) ? clone $this->rules[$name] : null;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->rules[$name]);
    }
}
