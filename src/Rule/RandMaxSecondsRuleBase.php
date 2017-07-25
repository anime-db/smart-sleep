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
     * @return int
     */
    public function seconds()
    {
        return rand(0, parent::seconds());
    }
}
