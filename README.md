[![Latest Stable Version](https://img.shields.io/packagist/v/anime-db/smart-sleep.svg?maxAge=3600&label=stable)](https://packagist.org/packages/anime-db/smart-sleep)
[![Total Downloads](https://img.shields.io/packagist/dt/anime-db/smart-sleep.svg?maxAge=3600)](https://packagist.org/packages/anime-db/smart-sleep)
[![Build Status](https://img.shields.io/travis/anime-db/smart-sleep.svg?maxAge=3600)](https://travis-ci.org/anime-db/smart-sleep)
[![Coverage Status](https://img.shields.io/coveralls/anime-db/smart-sleep.svg?maxAge=3600)](https://coveralls.io/github/anime-db/smart-sleep?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/anime-db/smart-sleep.svg?maxAge=3600)](https://scrutinizer-ci.com/g/anime-db/smart-sleep/?branch=master)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/22dbc4bf-167a-468b-b84e-014f4a8d23ff.svg?maxAge=3600&label=SLInsight)](https://insight.sensiolabs.com/projects/22dbc4bf-167a-468b-b84e-014f4a8d23ff)
[![StyleCI](https://styleci.io/repos/61719557/shield?branch=master)](https://styleci.io/repos/61719557)
[![License](https://img.shields.io/packagist/l/anime-db/smart-sleep.svg?maxAge=3600)](https://github.com/anime-db/smart-sleep)

# SmartSleep util

## Installation

Pretty simple with [Composer](http://packagist.org), run:

```sh
composer require anime-db/smart-sleep
```

## How-to

First build schedule

```php
use AnimeDb\SmartSleep\Rule\EverydayRule;
use AnimeDb\SmartSleep\Schedule;

$schedule = new Schedule([
    new EverydayRule(0, 3, 260), // [00:00, 03:00)
    new EverydayRule(3, 9, 900), // [03:00, 09:00)
    new EverydayRule(9, 19, 160), // [09:00, 19:00)
    new EverydayRule(19, 23, 70), // [19:00, 23:00)
    new EverydayRule(23, 24, 60), // [23:00, 24:00)
]);
```

Configure SmartSleep

```php
use AnimeDb\SmartSleep\SmartSleep;

$smart = new SmartSleep($schedule);
```

And now we can sleep

```php
$seconds = $smart->sleepForSeconds(new \DateTime());

sleep($seconds);
```

## License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: LICENSE
