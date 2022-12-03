<?php

require "vendor/autoload.php";

use App\Utils;

$inputs = Utils::getInput($argc, $argv);
$priorities = array_flip(array_merge([0 => 0], range('a', 'z'), range('A', 'Z')));

$priorityScore = 0;
$groupPrioritiesScore = 0;

$groups = [];
foreach ($inputs as $input) {
    $groups[] = getLettersAsArray($input);
    if (count($groups) === 3) {
        $groupPrioritiesScore += $priorities[findMatchingItem(...$groups)];

        $groups = [];
    }

    $compartments = str_split($input, strlen($input) / 2);
    $priorityScore += $priorities[
        findMatchingItem(
            getLettersAsArray($compartments[0]),
            getLettersAsArray($compartments[1]),
        )
    ];
}

echo 'first part: ' . $priorityScore . PHP_EOL;
echo 'second part: ' . $groupPrioritiesScore . PHP_EOL;

function findMatchingItem(array ...$arguments): string
{
    $matchingItem = array_intersect(...$arguments);

    return reset($matchingItem);
}

function getLettersAsArray(string $string): array
{
    return array_values(str_split($string));
}