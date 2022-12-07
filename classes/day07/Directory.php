<?php

namespace App\day07;

class Directory
{
    private string $name;

    private ?Directory $parentDir;

    /** @var Directory[] $childDirectories  */
    private array $childDirectories = [];

    private array $files = [];

    private int $totalSize = 0;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Directory
    {
        $this->name = $name;
        return $this;
    }

    public function getParentDir(): ?Directory
    {
        return $this->parentDir;
    }

    public function setParentDir(?Directory $parentDir): ?Directory
    {
        $this->parentDir = $parentDir;
        return $this;
    }

    public function getChildDirectories(): array
    {
        return $this->childDirectories;
    }

    public function setChildDirectories(array $childDirectories): Directory
    {
        $this->childDirectories = $childDirectories;
        return $this;
    }

    public function addChildDirectory(Directory $directory): self
    {
        array_push($this->childDirectories, $directory);
        return $this;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function setFiles(array $files): Directory
    {
        $this->files = $files;
        return $this;
    }

    public function addFile(File $file): self
    {
        array_push($this->files, $file);
        return $this;
    }

    public function getTotalSize(): int
    {
        return $this->totalSize;
    }

    public function setTotalSize(int $totalSize): Directory
    {
        $this->totalSize = $totalSize;
        return $this;
    }

    public function addTotalSize(int $size): self
    {
        $this->totalSize += $size;
        return $this;
    }
}