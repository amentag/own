<?php

namespace Tool\Archiver\Archive;

use ZipArchive;

class ArchiveZip extends AbstractArchive
{
    protected $zip;

    public function __construct(string $archivePath)
    {
        parent::__construct($archivePath);

        $this->zip = new ZipArchive();
    }

    public function create(string $sourcePath)
    {
        if ($this->zip->open($this->archivePath, ZipArchive::CREATE) !== true) {
            return false;
        }

        $filename = pathinfo($sourcePath, PATHINFO_BASENAME);

        $this->zip->addFile($sourcePath, $filename);

        $this->zip->close();
    }

    public function extract(string $directory)
    {
        if (!$this->zip->open($this->archivePath)) {
            return false;
        }

        for ($i = 0; $i < $this->zip->numFiles; $i++) {
            $name = $this->zip->getNameIndex($i);

            $this->zip->extractTo($directory, $name);
        }

        $this->zip->close();
    }
}