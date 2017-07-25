<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

trait HourIntervalRuleTrait
{
    /**
     * @var int
     */
    private $start = -1;

    /**
     * @var int
     */
    private $end = -1;

    /**
     * @param int $start
     */
    protected function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @param int $end
     */
    protected function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @return int
     */
    public function start()
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function end()
    {
        return $this->end;
    }
}
