<?php

namespace Tool\Archiver\Archive;

abstract class AbstractArchive implements ArchiveInterface
{
    /**
     * @var string
     */
    protected $archivePath;

    public function __construct(string $archivePath)
    {
        $this->archivePath = $archivePath;
    }
}