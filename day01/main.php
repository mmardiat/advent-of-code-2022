<?php

require "vendor/autoload.php";

use App\Utils;

$inputs = Utils::getInput($argc, $argv);
$lastKey = array_key_last($inputs);

$topCalories = 0;
$currentCalories = 0;
$totalCaloriesPerElf = [];
foreach ($inputs as $key => $calories) {
    $currentCalories += (int) $calories;

    if (strlen(trim($calories)) === 0 || $key === $lastKey) {
        $totalCaloriesPerElf = calculateCaloriesPerElf($totalCaloriesPerElf, $currentCalories);

        if ($topCalories < $currentCalories) {
            $topCalories = $currentCalories;
        }

        $currentCalories = 0;
    }
}

function calculateCaloriesPerElf(array $totalCaloriesPerElf, int $currentCalories): array
{
    if (count($totalCaloriesPerElf) < 3) {
        $totalCaloriesPerElf[$currentCalories] = $currentCalories;

        return $totalCaloriesPerElf;
    }

    $minCalories = min($totalCaloriesPerElf);
    if ($currentCalories > $minCalories) {
        unset($totalCaloriesPerElf[$minCalories]);
        $totalCaloriesPerElf[$currentCalories] = $currentCalories;
    }

    return $totalCaloriesPerElf;
}

echo 'part one: ' . $topCalories . PHP_EOL;
echo 'part two: ' . array_sum($totalCaloriesPerElf) . PHP_EOL;


