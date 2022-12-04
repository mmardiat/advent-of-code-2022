<?php

require "vendor/autoload.php";

use App\Utils;

$inputs = Utils::getInput($argc, $argv);
$pointlessInstructionCount = 0;
$partlyOverlappingCount = 0;
foreach ($inputs as $k => $assignment) {
    $assignmentPerElf = explode(',', $assignment);
    $firstElfPoints = explode('-', $assignmentPerElf[0]);
    $secondElfPoints = explode('-', $assignmentPerElf[1]);

    if (($firstElfPoints[0] <= $secondElfPoints[0] && $firstElfPoints[1] >= $secondElfPoints[1]) ||
        ($secondElfPoints[0] <= $firstElfPoints[0] && $secondElfPoints[1] >= $firstElfPoints[1])) {
        $pointlessInstructionCount++;
    }


    if (array_intersect_key(array_flip(range($firstElfPoints[0], $firstElfPoints[1])), array_flip(range($secondElfPoints[0], $secondElfPoints[1])))) {
        $partlyOverlappingCount++;
    }
}

echo 'first part: ' . $pointlessInstructionCount . PHP_EOL;
echo 'first part: ' . $partlyOverlappingCount . PHP_EOL;
