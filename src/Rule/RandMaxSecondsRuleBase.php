<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

abstract class RandMaxSecondsRuleBase extends RuleBase
{
    /**
     * Default sleep at least seconds.
     *
     * @var int
     */
    const DEFAULT_MIN_SLEEP_SECONDS = 10;

    /**
     * @var int
     */
    protected $min_sleep_seconds;

    /**
     * @param int $min_sleep_seconds
     */
    public function __construct($min_sleep_seconds = self::DEFAULT_MIN_SLEEP_SECONDS)
    {
        $this->min_sleep_seconds = $min_sleep_seconds;
    }

    /**
     * @return int
     */
    public function getSeconds()
    {
        return rand($this->min_sleep_seconds, parent::getSeconds());
    }
}
