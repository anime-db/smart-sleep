<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

use AnimeDb\SmartSleep\Rule\EverydayRule;
use AnimeDb\SmartSleep\SmartSleep;
use AnimeDb\SmartSleep\Schedule;

require __DIR__.'/../bootstrap.php';

$smart = new SmartSleep(new Schedule([
    (new EverydayRule())->setStart(9)->setEnd(15)->setSeconds(100), // [9:00, 15:00)
    (new EverydayRule())->setStart(17)->setEnd(21)->setSeconds(60), // [17:00, 21:00)
]));

$seconds = $smart->getSleepSeconds(new \DateTime());

echo sprintf('sleep %s s.'.PHP_EOL, $seconds);
sleep($seconds);
