<?php

require "vendor/autoload.php";

use App\Utils;

$inputs = Utils::getInput($argc, $argv);
$lastKey = array_key_last($inputs);

const OPPONENT_ROCK = 'A';
const OPPONENT_PAPER = 'B';
const OPPONENT_SCISSORS = 'C';

const YOU_ROCK = 'X';
const YOU_PAPER = 'Y';
const YOU_SCISSORS = 'Z';

const STRATEGY_LOSE = 'X';
const STRATEGY_WIN = 'Z';

const WINNING_MOVES = [
    OPPONENT_ROCK => YOU_PAPER,
    OPPONENT_PAPER => YOU_SCISSORS,
    OPPONENT_SCISSORS => YOU_ROCK,
];

const LOSING_MOVES = [
    OPPONENT_ROCK => YOU_SCISSORS,
    OPPONENT_PAPER => YOU_ROCK,
    OPPONENT_SCISSORS => YOU_PAPER,
];

const MOVE_CONVERSION_TABLE = [
    OPPONENT_ROCK => YOU_ROCK,
    OPPONENT_PAPER => YOU_PAPER,
    OPPONENT_SCISSORS => YOU_SCISSORS,
];

const MOVE_SCORING_TABLE = [
    YOU_ROCK => 1,
    YOU_PAPER => 2,
    YOU_SCISSORS => 3,
];

$myFairScore = 0;
$myStratScore = 0;
foreach ($inputs as $match) {
    $moves = explode(' ', $match);
    $myFairScore += decideWinner($moves[0], $moves[1]);
    $myStratScore += decideWinner($moves[0], chooseMove($moves[0], $moves[1]));

}

echo 'first part: ' . $myFairScore . PHP_EOL;
echo 'second part: ' . $myStratScore . PHP_EOL;

function chooseMove(string $opponentsMove, string $strategy): string
{
    if ($strategy === STRATEGY_WIN) {
        return WINNING_MOVES[$opponentsMove];
    } elseif ($strategy === STRATEGY_LOSE) {
        return LOSING_MOVES[$opponentsMove];
    } else {
        return MOVE_CONVERSION_TABLE[$opponentsMove];
    }
}

function decideWinner(string $opponentsMove, string $yourMove): int
{
    $points = MOVE_SCORING_TABLE[$yourMove];
    if (MOVE_CONVERSION_TABLE[$opponentsMove] === $yourMove) {
        return $points + 3;
    }

    if (WINNING_MOVES[$opponentsMove] === $yourMove) {
        return $points + 6;
    }

    return $points;
}