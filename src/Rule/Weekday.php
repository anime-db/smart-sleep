<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */
namespace AnimeDb\SmartSleep\Rule;

class Weekday extends RandMaxSecondsBase
{
    /**
     * @param \DateTime $time
     *
     * @return bool
     */
    public function isMatched(\DateTime $time)
    {
        return $time->format('N') <= 5 &&
            $this->getStart() <= $time->format('G') &&
            $this->getEnd() > $time->format('G');
    }
}