<?php

include 'helpers.php';

$p1ValidCount = 0;
$p2ValidCount = 0;
foreach (getDayInputByLine(2) as $pwLine) {
    $lineParts = explode(':', $pwLine);
    $pw = trim($lineParts[1]);

    $ruleParts = explode(' ', $lineParts[0]);
    $char = $ruleParts[1];

    $ruleLengthParts = explode('-', $ruleParts[0]);
    $minLen = (int)$ruleLengthParts[0];
    $maxLen = (int)$ruleLengthParts[1];

    $charCount = 0;

    // Part 1
    for ($i = 0; $i < strlen($pw); $i++) {
        if ($pw[$i] == $char) $charCount++;

        if ($charCount > $maxLen) continue;
    }

    // Part 2;
    if (
        isset($pw[$minLen - 1]) && $pw[$minLen - 1] == $char
        && (!isset($pw[$maxLen - 1]) || $pw[$maxLen - 1] != $char)
    ) {
        $p2ValidCount++;
    }

    if (
        isset($pw[$maxLen - 1]) && $pw[$maxLen - 1] == $char
        && (!isset($pw[$minLen - 1]) || $pw[$minLen - 1] != $char)
    ) {
        $p2ValidCount++;
    }

    if ($charCount > $maxLen) continue;
    if ($charCount >= $minLen) $p1ValidCount++;
}

echo "Part 1 valid count: {$p1ValidCount}" . PHP_EOL;
echo "Part 2 valid count: {$p2ValidCount}" . PHP_EOL;
echo "Run time: " . getExecutionTime() . PHP_EOL;