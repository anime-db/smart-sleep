<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep;

use AnimeDb\SmartSleep\Rule\RuleInterface;

class Chain
{
    /**
     * @var RuleInterface[]
     */
    protected $rules = [];

    /**
     * @param RuleInterface $rule
     * @param string $name
     */
    public function addRule(RuleInterface $rule, $name)
    {
        $this->rules[$name] = $rule;
    }

    /**
     * @param string $name
     *
     * @return RuleInterface|null
     */
    public function getRule($name)
    {
        return isset($this->rules[$name]) ? clone $this->rules[$name] : null;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasRule($name)
    {
        return isset($this->rules[$name]);
    }
}
