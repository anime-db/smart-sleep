<?php
/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, 'Peter Gribanov
 */
use AnimeDb\SmartSleep\Rule\HolidayRule;
use AnimeDb\SmartSleep\Rule\WeekdayRule;
use AnimeDb\SmartSleep\RuleCollection;
use AnimeDb\SmartSleep\ScheduleBuilder;
use AnimeDb\SmartSleep\SmartSleep;

require __DIR__.'/../bootstrap.php';

echo 'Functional test: Build schedule.'.PHP_EOL;

$schedule = [
    ['rule' => 'weekday', 'start' => 0, 'end' => 2, 'seconds' => 600],
    ['rule' => 'weekday', 'start' => 1, 'end' => 7, 'seconds' => 800],
    ['rule' => 'weekday', 'start' => 7, 'end' => 10, 'seconds' => 100],
    ['rule' => 'weekday', 'start' => 10, 'end' => 19, 'seconds' => 160],
    ['rule' => 'weekday', 'start' => 19, 'end' => 22, 'seconds' => 70],
    ['rule' => 'weekday', 'start' => 22, 'end' => 24, 'seconds' => 260],
    ['rule' => 'holiday', 'start' => 0, 'end' => 3, 'seconds' => 260],
    ['rule' => 'holiday', 'start' => 3, 'end' => 9, 'seconds' => 900],
    ['rule' => 'holiday', 'start' => 9, 'end' => 19, 'seconds' => 160],
    ['rule' => 'holiday', 'start' => 19, 'end' => 23, 'seconds' => 70],
    ['rule' => 'holiday', 'start' => 23, 'end' => 24, 'seconds' => 260],
];

$collection = new RuleCollection();
$collection->set('weekday', new WeekdayRule());
$collection->set('holiday', new HolidayRule());

$builder = new ScheduleBuilder($collection);

$smart = new SmartSleep($builder->buildSchedule($schedule));

$seconds = $smart->sleepForSeconds(new \DateTime());

echo sprintf('Sleep %s s.'.PHP_EOL, $seconds);
