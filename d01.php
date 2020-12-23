<?php

include 'helpers.php';

$nums = [];
foreach (getDayInputByLine(1) as $num) {
    array_push($nums, (int)$num);
}

rsort($nums, SORT_NUMERIC);
$size = count($nums);

// Part 1
for ($i = 0; $i <= $size-1; $i++) {
    for ($j = ($size-1); $j >= $i; $j--) {
        if ($nums[$i] + $nums[$j] > 2020) continue 2;

        if ($nums[$i] + $nums[$j] < 2020) continue;

        echo "Multiply of {$nums[$i]} and {$nums[$j]} is: " . ($nums[$i] * $nums[$j]);
        echo PHP_EOL;
        break 2;
    }
}

echo "Run time: " . getExecutionTime(true) . PHP_EOL;

// Part 2
for ($i = 0; $i <= $size-1; $i++) {
    for ($j = ($size-1); $j >= $i; $j--) {
        $remaining = 2020 - ($nums[$i] + $nums[$j]);

        if ($remaining < 0) continue 2;

        if ($remaining > 0) {
            for ($k = ($j-1); $k >= 0; $k--) {
                if ($nums[$k] > $remaining) continue 2;

                if ($nums[$k] < $remaining) continue;

                if ($nums[$k] === $remaining) {
                    echo "Multiply of {$nums[$i]}, {$nums[$k]}, and {$nums[$j]} is: "
                        . ($nums[$k] * $nums[$i] * $nums[$j]);
                    echo PHP_EOL;
                    break 3;
                }
            }
        }
    }
}

echo "Run time: " . getExecutionTime() . PHP_EOL;