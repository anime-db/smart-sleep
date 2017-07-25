<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep;

use AnimeDb\SmartSleep\Rule\Rule;

class RuleCollection
{
    /**
     * @var Rule[]
     */
    private $rules = [];

    /**
     * @param string $name
     * @param Rule $rule
     *
     * @return RuleCollection
     */
    public function set($name, Rule $rule)
    {
        $this->rules[$name] = clone $rule;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return Rule|null
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
