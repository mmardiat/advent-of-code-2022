<?php

require "vendor/autoload.php";

use App\Utils;

$inputs = Utils::getInput($argc, $argv);
$stacks = [];
$secondPartStacks = [];
foreach ($inputs as $inputRow) {
    if (strlen($inputRow) === 0) {
        continue;
    }

    if (filter_var(str_replace(' ', '', $inputRow), FILTER_VALIDATE_INT)) {
        foreach ($stacks as $k => $stack) {
            $stacks[$k] = array_reverse($stack);
        }

        ksort($stacks);

        $secondPartStacks = $stacks;
        continue;
    }

    if (trim($inputRow) && !str_contains($inputRow, 'move')) {
        $stacks = addBlocksToStack($inputRow, $stacks);

        continue;
    }

    preg_match_all('!\d+!', $inputRow, $matches);
    $instructions = $matches[0];
    $secondPartAppendArray = [];
    for ($x = 0; $x < $instructions[0]; $x++) {
        array_push($stacks[$instructions[2]], array_pop($stacks[$instructions[1]]));
        array_push($secondPartAppendArray, array_pop($secondPartStacks[$instructions[1]]));
    }

    $secondPartStacks[$instructions[2]] = array_merge(
        $secondPartStacks[$instructions[2]],
        array_reverse($secondPartAppendArray)
    );
}

echo 'first part: ' . getLettersFromArray($stacks) . PHP_EOL;
echo 'second part: ' . getLettersFromArray($secondPartStacks) . PHP_EOL;

function getLettersFromArray(array $array): string
{
    $result = '';
    foreach ($array as $stack) {
        $firstBlock = str_replace('[', '', $stack[array_key_last($stack)]);
        $firstBlock = str_replace(']', '', $firstBlock);
        $result .= $firstBlock;
    }
    return $result;
}

function addBlocksToStack(string $stackInfo, array $stacks): array
{
    $parsedString = '';
    foreach (str_split($stackInfo, 4) as $string) {
        if (!trim($string)) {
            $parsedString .= 'xxx ';

            continue;
        }

        $parsedString .= $string;
    }

    foreach (explode(' ', $parsedString) as $key => $block) {
        if ($block === 'xxx') {
            continue;
        }

        $stacks[$key + 1][] = $block;
    }

    return $stacks;
}