<?php
/**
 * @author Peter Gribanov <info@peter-gribanov.ru>
 */

/**
 * @param int $seconds
 *
 * @return string
 */
function formatSeconds($seconds)
{
    $hour = floor($seconds / 3600);
    $seconds = $hour ? $seconds % ($hour * 3600) : $seconds;

    $minute = floor($seconds / 60);
    $seconds = $minute ? $seconds % ($minute * 60) : $seconds;

    return sprintf('%s:%s:%s', $hour, $minute, $seconds);
}
