<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace AnimeDb\SmartSleep\Rule;

class WeekdayRule extends RandMaxSecondsRuleBase
{
    /**
     * @param \DateTime $time
     *
     * @return bool
     */
    public function isMatched(\DateTime $time)
    {
        return $time->format('N') <= 5 &&
            $this->start() <= $time->format('G') &&
            $this->end() > $time->format('G');
    }
}
