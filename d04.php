<?php

include 'helpers.php';

$validP1 = 0;
$validP2 = 0;
$fields = [];

$inputByLine = getDayInputByLine(4);

while ($inputByLine->valid()) {
    $line = $inputByLine->current();

    if ($line === PHP_EOL) {
        if (isValidPassportP1($fields)) $validP1++;
        if (isValidPassportP2($fields)) $validP2++;

        $fields = [];
        $inputByLine->next();
        continue;
    }

    $fields = array_merge($fields, explode(' ', $line));

    $inputByLine->next();

    if (!$inputByLine->valid() && count($fields) > 0) {
        // Last line has something. Needs to check it too.
        if (isValidPassportP1($fields)) $validP1++;
        if (isValidPassportP2($fields)) $validP2++;
    }
}

function isValidPassportP1($fields)
{
    if (count($fields) === 8) return true;

    if (count($fields) === 7) {
        // If there's 7 fields, only cid can be missing
        $cid = array_filter($fields, fn ($x) => substr($x, 0, 3) === 'cid');
        return count($cid) === 0;
    }

    return false;
}

function isValidPassportP2($fields)
{
    // Must still have at least 7 fields to be valid
    if (count($fields) < 7) return false;

    $countField = 0;
    foreach ($fields as $field) {
        list($code, $val) = explode(':', $field);
        $val = trim($val);

        switch ($code) {
            case 'byr': // Birth year
                $countField++;
                $intVal = (int)$val;
                if ($intVal < 1920 || $intVal > 2002) return false;
                break;

            case 'iyr': // Issue year
                $countField++;
                $intVal = (int)$val;
                if ($intVal < 2010 || $intVal > 2020) return false;
                break;

            case 'eyr': // Expiration year
                $countField++;
                $intVal = (int)$val;
                if ($intVal < 2020 || $intVal > 2030) return false;
                break;

            case 'hgt': // Height
                $countField++;
                $unit = substr($val, -2);
                if ($unit === 'cm') {
                    $intVal = (int)substr($val, 0, -2);
                    if ($intVal < 150 || $intVal > 193) return false;
                } else if ($unit === 'in') {
                    $intVal = (int)substr($val, 0, -2);
                    if ($intVal < 59 || $intVal > 76) return false;
                } else {
                    return false;
                }
                break;

            case 'hcl': // Hair color
                $countField++;
                if (!preg_match("/^#[a-f0-9]{6}$/", $val)) return false;
                break;

            case 'ecl': // Eye color
                $countField++;
                if (!in_array($val, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) return false;
                break;

            case 'pid': // Passport id
                $countField++;
                if (!preg_match('/^[0-9]{9}$/', $val)) return false;
                break;
        }
    }

    if ($countField === 7) return true;
}

// echo "Num passports: {$passports}" . PHP_EOL;
echo "Part 1 - Valid Passports Count: {$validP1}" . PHP_EOL;
echo "Part 2 - Valid Passports Count: {$validP2}" . PHP_EOL;
echo "Run time: " . getExecutionTime(true) . PHP_EOL;