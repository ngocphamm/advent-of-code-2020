<?php

include 'helpers.php';

function getRange($min, $max, $letter)
{
    if ($letter === 'F' || $letter === 'L') {
        return [$min, $min + ($max + 1 - $min) / 2 - 1];
    }

    if ($letter === 'B' || $letter === 'R') {
        return [$min + ($max + 1 - $min) / 2, $max];
    }
}

$seatIds = [];
foreach (getDayInputByLine(5) as $input) {
    $min = 0; $max = 127;
    for ($i = 0; $i < 7; $i++) {
        list($min, $max) = getRange($min, $max, $input[$i]);
    }

    $row = $min;

    $min = 0; $max = 7;
    for ($i = 7; $i < 10; $i++) {
        list($min, $max) = getRange($min, $max, $input[$i]);
    }

    $col = $min;

    $seatIds[] = $row * 8 + $col;
}

sort($seatIds, SORT_NUMERIC);

echo "Max Seat ID: {$seatIds[count($seatIds) - 1]}" . PHP_EOL;
echo "Run time: " . getExecutionTime(true) . PHP_EOL;

for ($i = 1; $i < count($seatIds) - 1; $i++) {
    if ($seatIds[$i + 1] !== $seatIds[$i] + 1) {
        $yourSeat = $seatIds[$i] + 1;
        echo "Your Seat ID: {$yourSeat}" . PHP_EOL;
        break;
    }
}
echo "Run time: " . getExecutionTime(true) . PHP_EOL;