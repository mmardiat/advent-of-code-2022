<?php

namespace App\day07;

class Command
{
    private string $command;
    private ?string $parameter;

    public function getCommand(): string
    {
        return $this->command;
    }

    public function setCommand(string $command): Command
    {
        $this->command = $command;
        return $this;
    }

    public function getParameter(): ?string
    {
        return $this->parameter;
    }

    public function setParameter(?string $parameter): Command
    {
        $this->parameter = $parameter;
        return $this;
    }
}