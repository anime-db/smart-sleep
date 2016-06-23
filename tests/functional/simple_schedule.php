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

echo 'Simple schedule functional test.'.PHP_EOL;

$smart = new SmartSleep(new Schedule([
    (new EverydayRule())->setStart(0)->setEnd(3)->setSeconds(260), // [00:00, 03:00)
    (new EverydayRule())->setStart(3)->setEnd(9)->setSeconds(900), // [03:00, 09:00)
    (new EverydayRule())->setStart(9)->setEnd(19)->setSeconds(160), // [09:00, 19:00)
    (new EverydayRule())->setStart(19)->setEnd(23)->setSeconds(70), // [19:00, 23:00)
    (new EverydayRule())->setStart(23)->setEnd(24)->setSeconds(60), // [23:00, 24:00)
]));

$seconds = $smart->getSleepSeconds(new \DateTime());

echo sprintf('Sleep %s s.'.PHP_EOL, $seconds);
