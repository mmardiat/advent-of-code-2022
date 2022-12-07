<?php

require "vendor/autoload.php";

use App\day07\Command;
use App\day07\Directory;
use App\day07\File;
use App\Utils;

const COMMAND_CD = 'cd';
const COMMAND_LS = 'ls';

const COMMAND_PARAM_BACK = '..';
const COMMAND_PARAM_ROOT = '/';

$inputs = Utils::getInput($argc, $argv);
$dirSizes = [];
$activeDirectory = (new Directory())->setName('/');
$firstPart = 0;
foreach ($inputs as $terminalLine) {
    if (str_starts_with($terminalLine, '$')) {
        $command = extractCommand($terminalLine);

        if ($command->getCommand() === COMMAND_CD) {
            $commandParameter = $command->getParameter();
            if ($commandParameter === COMMAND_PARAM_BACK) {
                if ($activeDirectory->getParentDir()) {
                    if ($activeDirectory->getTotalSize() <= 100000) {
                        // so fucking close tho
                        // small thing that brings me joy from jetbrains - the word fuck has a line under it and has a message:
//                        This word is considered offensive.
//                        Incorrect:
//                        Piss off!
                        echo 'dir ' . $activeDirectory->getName() . ' size ' . $activeDirectory->getTotalSize() . PHP_EOL;
//                        $firstPart += $activeDirectory->getTotalSize();
                    }

                    if ($activeDirectory->getTotalSize() + $activeDirectory->getParentDir()->getTotalSize() <= 100000) {
                        $firstPart += $activeDirectory->getTotalSize() + $activeDirectory->getParentDir()->getTotalSize();
                    }

                    $activeDirectory = $activeDirectory->getParentDir();
                }
            } else {
                $newActiveDirectory = (new Directory())
                    ->setName($commandParameter)
                    ->setParentDir($activeDirectory);

                $activeDirectory->addChildDirectory($newActiveDirectory);
                $activeDirectory = $newActiveDirectory;
            }

            continue;
        }

        if ($command->getCommand() === COMMAND_LS) {
            continue;
        }
    }

    if (str_starts_with($terminalLine, 'dir')) {
        $childDir = (new Directory())->setName(substr($terminalLine, 2));
        $activeDirectory->addChildDirectory($childDir);

        continue;
    }

    $fileParameters = explode(' ', $terminalLine);
    $file = (new File())
        ->setSize((int) $fileParameters[0])
        ->setName($fileParameters[1]);

    $activeDirectory->addFile($file);
    $activeDirectory->addTotalSize($file->getSize());
}

//echo 'first part: ' . $firstPart . PHP_EOL;

function extractCommand(string $commandLineInput): Command
{
    $command = substr($commandLineInput, 2);
    $commandParts = explode(' ', $command);

    $command = (new Command())->setCommand($commandParts[0]);
    if (isset($commandParts[1])) {
        $command->setParameter($commandParts[1]);
    }

    return $command;
}