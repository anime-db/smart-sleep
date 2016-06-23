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
    $seconds = $seconds % ($hour * 3600);

    $minute = floor($seconds / 60);
    $seconds = $seconds % ($minute * 60);

    return sprintf('%s:%s:%s', $hour, $minute, $seconds);
}
