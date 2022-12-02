<?php

require "vendor/autoload.php";

use App\Utils;

$inputs = Utils::getInput($argc, $argv);

$topCalories = 0;
$currentCalories = 0;
$totalCaloriesPerElf = [0, 0, 0];
foreach ($inputs as $calories) {
    if (strlen(trim($calories)) === 0) {
        if ($currentCalories > min($totalCaloriesPerElf)) {
            $totalCaloriesPerElf[] = $currentCalories;
        }

        if ($topCalories < $currentCalories) {
            $topCalories = $currentCalories;
        }

        $currentCalories = 0;

        continue;
    }

    $currentCalories += (int) $calories;
}

echo $topCalories . PHP_EOL;


