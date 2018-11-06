<?php

namespace Tool\Archiver\Archive;

use PharData;

class ArchiveTar extends AbstractArchive
{
    /**
     * @var PharData
     */
    protected $tar;

    public function __construct(string $archivePath)
    {
        parent::__construct($archivePath);

        $this->tar = new PharData($archivePath);
    }
    public function create(string $sourcePath)
    {
        $filename = pathinfo($sourcePath, PATHINFO_BASENAME);

        $this->tar->addFile(realpath($sourcePath), $filename);
    }

    public function extract(string $directory)
    {
        // todo : extract file by file
        $this->tar->extractTo($directory);
    }
}