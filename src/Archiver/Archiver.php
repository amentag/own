<?php

namespace Tool\Archiver;

use Exception;
use Tool\Archiver\Archive\ArchiveConstant;
use Tool\Archiver\Archive\ArchiveInterface;
use Tool\Filesystem\FileInfo;

class Archiver
{
    /**
     * @var FileInfo
     */
    private $archiveFactory;
    /**
     * @var FileInfo
     */
    private $fileInfo;

    public function __construct(ArchiveFactory $archiveFactory, FileInfo $fileInfo)
    {
        $this->archiveFactory = $archiveFactory;
        $this->fileInfo = $fileInfo;
    }

    /**
     * @return ArchiveInterface|bool
     * @throws Exception
     */
    public function load(string $archivePath)
    {
        if (!$this->fileInfo->isArchive($archivePath)) {
            throw new Exception("File $archivePath is not an archive.", ArchiveConstant::ERROR_NOT_ARCHIVE);
        }

        return $this->archiveFactory->make($this->fileInfo->getMimeType($archivePath), $archivePath);
    }

    public function make(string $mimeType, string $archivePath)
    {
        return $this->archiveFactory->make($mimeType, $archivePath);
    }

    public function getMimeTypes(): array
    {
        return [
            FileInfo::MIME_TYPE_7ZIP,
            FileInfo::MIME_TYPE_GZIP,
            FileInfo::MIME_TYPE_RAR,
            FileInfo::MIME_TYPE_TAR,
            FileInfo::MIME_TYPE_ZIP,
        ];
    }
}