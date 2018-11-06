<?php

namespace Tool\Archiver\Archive;

interface ArchiveInterface
{
    public function create(string $sourcePath);

    public function extract(string $directory);
}