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

echo 'Functional test: Simple schedule.'.PHP_EOL;

$smart = new SmartSleep(new Schedule([
    new EverydayRule(0, 3, 260), // [00:00, 03:00)
    new EverydayRule(3, 9, 900), // [03:00, 09:00)
    new EverydayRule(9, 19, 160), // [09:00, 19:00)
    new EverydayRule(19, 23, 70), // [19:00, 23:00)
    new EverydayRule(23, 24, 60), // [23:00, 24:00)
]));

$seconds = $smart->sleepForSeconds(new \DateTime());

echo sprintf('Sleep %s s.'.PHP_EOL, $seconds);
