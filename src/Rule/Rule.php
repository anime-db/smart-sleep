<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

interface Rule
{
    /**
     * @return int
     */
    public function start();

    /**
     * @param int $start
     *
     * @return Rule
     */
    public function setStart($start);

    /**
     * @return int
     */
    public function end();

    /**
     * @param int $end
     *
     * @return Rule
     */
    public function setEnd($end);

    /**
     * @return int
     */
    public function seconds();

    /**
     * @param int $seconds
     *
     * @return Rule
     */
    public function setSeconds($seconds);

    /**
     * @param \DateTime $time
     *
     * @return bool
     */
    public function isMatched(\DateTime $time);
}
