<?php

include 'helpers.php';

$inputByLine = getDayInputByLine(6);

$totalAnswerCount = 0;
$totalAllAnswerCount = 0;
$groupAnswers = [];
$groupAllAnswers = range('a', 'z');

while ($inputByLine->valid()) {
    $line = $inputByLine->current();

    if ($line === PHP_EOL) {
        $totalAnswerCount += count($groupAnswers);
        $totalAllAnswerCount += count($groupAllAnswers);

        $groupAnswers = []; // Reset for the next group
        $groupAllAnswers = range('a', 'z'); // Reset for the next group
        $inputByLine->next();
        continue;
    }

    $inputByLine->next();

    $answers = str_split(trim($line));
    // For part 1
    foreach ($answers as $answer) {
        if (!in_array($answer, $groupAnswers)) {
            $groupAnswers[] = $answer;
        }
    }

    // For part 2
    $groupAllAnswers = array_intersect($groupAllAnswers, $answers);

    if (!$inputByLine->valid()) {
        $totalAnswerCount += count($groupAnswers);
        $totalAllAnswerCount += count($groupAllAnswers);
    }
}

echo "Sum of answers: {$totalAnswerCount}" . PHP_EOL;
echo "Sum of answers: {$totalAllAnswerCount}" . PHP_EOL;
echo "Run time: " . getExecutionTime() . PHP_EOL;
