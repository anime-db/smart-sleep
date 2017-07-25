<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

abstract class RuleBase implements Rule
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
     * @var int
     */
    private $seconds = 0;

    /**
     * @return int
     */
    public function start()
    {
        return $this->start;
    }

    /**
     * @param int $start
     *
     * @return RuleBase
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return int
     */
    public function end()
    {
        return $this->end;
    }

    /**
     * @param int $end
     *
     * @return RuleBase
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return int
     */
    public function seconds()
    {
        return $this->seconds;
    }

    /**
     * @param int $seconds
     *
     * @return RuleBase
     */
    public function setSeconds($seconds)
    {
        $this->seconds = $seconds;

        return $this;
    }
}
