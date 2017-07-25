<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

interface RuleInterface
{
    /**
     * @return int
     */
    public function getStart();

    /**
     * @param int $start
     *
     * @return RuleInterface
     */
    public function setStart($start);

    /**
     * @return int
     */
    public function getEnd();

    /**
     * @param int $end
     *
     * @return RuleInterface
     */
    public function setEnd($end);

    /**
     * @return int
     */
    public function getSeconds();

    /**
     * @param int $seconds
     *
     * @return RuleInterface
     */
    public function setSeconds($seconds);

    /**
     * @param \DateTime $time
     *
     * @return bool
     */
    public function isMatched(\DateTime $time);
}
