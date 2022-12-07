<?php

require "vendor/autoload.php";

use App\Utils;

$inputs = Utils::getInput($argc, $argv);
/** @var string $input */
$input = $inputs[0];

$uniqueLetters = '';
$uniqueLetterIndex = 1;
$uniqueMessageIndex = 1;
foreach (str_split($input) as $key => $letter) {
    $uniqueLetters .= $letter;
    if (strlen($uniqueLetters) < 4) {
        continue;
    }

    if (count(array_unique(str_split(substr($uniqueLetters, -4)))) === 4 && $uniqueLetterIndex === 1) {
        $uniqueLetterIndex += $key;

        continue;
    }

    if (count(array_unique(str_split(substr($uniqueLetters, -14)))) === 14) {
        $uniqueMessageIndex += $key;
        break;
    }
}

echo 'first part: ' . $uniqueLetterIndex . PHP_EOL;
echo 'second part: ' . $uniqueMessageIndex . PHP_EOL;