<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

interface HourIntervalRule extends Rule
{
    /**
     * @return int
     */
    public function start();

    /**
     * @return int
     */
    public function end();
}
