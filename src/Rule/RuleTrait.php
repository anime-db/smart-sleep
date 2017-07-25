<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

trait RuleTrait
{
    /**
     * @var int
     */
    private $seconds = 0;

    /**
     * @param int $seconds
     */
    protected function setSeconds($seconds)
    {
        $this->seconds = $seconds;
    }

    /**
     * @return int
     */
    public function seconds()
    {
        return $this->seconds;
    }
}
