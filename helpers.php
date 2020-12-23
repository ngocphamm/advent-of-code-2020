<?php

$startTime = microtime(true);

function getExecutionTime(bool $reset = false) {
    global $startTime;

    $now = microtime(true);

    $elapsed = $now - $startTime;

    if ($reset) $startTime = $now;

    return $elapsed;
}

function getDayInputByLine(int $day)
{
    $dayWithZero = str_pad($day, 2, '0', STR_PAD_LEFT);

    $file = fopen("input/{$dayWithZero}.txt", 'r');

    try {
        while ($line = fgets($file)) {
            yield $line;
        }
    } finally {
        fclose($file);
    }
}

function getDayInput(int $day)
{
    $dayWithZero = str_pad($day, 2, '0', STR_PAD_LEFT);

    return trim(file_get_contents("input/{$dayWithZero}.txt"));
}