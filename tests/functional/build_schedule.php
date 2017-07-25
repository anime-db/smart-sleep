<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, 'Peter Gribanov
 */
use AnimeDb\SmartSleep\Rule\HolidayRule;
use AnimeDb\SmartSleep\Rule\WeekdayRule;
use AnimeDb\SmartSleep\ScheduleBuilder;
use AnimeDb\SmartSleep\SmartSleep;

require __DIR__.'/../bootstrap.php';

echo 'Functional test: Build schedule.'.PHP_EOL;

$schedule = [
    ['rule' => WeekdayRule::class, 'start' => 0, 'end' => 2, 'seconds' => 600],
    ['rule' => WeekdayRule::class, 'start' => 1, 'end' => 7, 'seconds' => 800],
    ['rule' => WeekdayRule::class, 'start' => 7, 'end' => 10, 'seconds' => 100],
    ['rule' => WeekdayRule::class, 'start' => 10, 'end' => 19, 'seconds' => 160],
    ['rule' => WeekdayRule::class, 'start' => 19, 'end' => 22, 'seconds' => 70],
    ['rule' => WeekdayRule::class, 'start' => 22, 'end' => 24, 'seconds' => 260],
    ['rule' => HolidayRule::class, 'start' => 0, 'end' => 3, 'seconds' => 260],
    ['rule' => HolidayRule::class, 'start' => 3, 'end' => 9, 'seconds' => 900],
    ['rule' => HolidayRule::class, 'start' => 9, 'end' => 19, 'seconds' => 160],
    ['rule' => HolidayRule::class, 'start' => 19, 'end' => 23, 'seconds' => 70],
    ['rule' => HolidayRule::class, 'start' => 23, 'end' => 24, 'seconds' => 260],
];

$builder = new ScheduleBuilder();
$schedule = $builder->buildSchedule($schedule);

$smart = new SmartSleep($schedule);

$seconds = $smart->sleepForSeconds(new \DateTime());

echo sprintf('Sleep %s s.'.PHP_EOL, $seconds);
