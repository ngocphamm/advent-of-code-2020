<?php

include 'helpers.php';

// Part 1
$x = 0;
$treeCount = 0;
$len = 0;
foreach (getDayInputByLine(3) as $line) {
    if ($len === 0) $len = strlen($line) - 1;

    if ($x >= $len) $x = $x % $len; // Because the grid repeats

    if ($line[$x] === '#') $treeCount++;

    $x += 3;
}

echo "Part 1 tree count: {$treeCount}" . PHP_EOL;
echo "Run time: " . getExecutionTime(true) . PHP_EOL;

// Part 2
$totalTree = 1;
foreach ([[1, 1], [3, 1], [5, 1], [7, 1], [1, 2]] as $jump) {
    $x = 0; $y = 1;
    $treeCount = 0;

    foreach (getDayInputByLine(3) as $line) {
        if ($jump[1] === 2 && $y % $jump[1] === 0) {
            $y++;
            continue;
        }

        if ($x >= $len) $x = $x % $len; // Because the grid repeats

        if ($line[$x] === '#') $treeCount++;

        $x += $jump[0];
        $y++;
    }

    $totalTree *= $treeCount;
}

echo "Part 2 tree count: {$totalTree}" . PHP_EOL;
echo "Run time: " . getExecutionTime() . PHP_EOL;