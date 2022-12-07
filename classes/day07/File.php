<?php

namespace App\day07;

class File
{
    private string $name;
    private int $size;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): File
    {
        $this->size = $size;
        return $this;
    }
}