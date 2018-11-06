<?php

namespace Tool\Filesystem;

use Exception;
use Tool\Archiver\Archive\ArchiveConstant;

class FileInfo
{
    // Text
    const MIME_TYPE_PLAIN = 'text/plain';
    const MIME_TYPE_HTML = 'text/html';

    // Archive
    const MIME_TYPE_7ZIP = 'application/x-7z-compressed';
    const MIME_TYPE_GZIP = 'application/x-gzip';
    const MIME_TYPE_RAR = 'application/x-rar-compressed';
    const MIME_TYPE_TAR = 'application/x-tar';
    const MIME_TYPE_ZIP = 'application/zip';

    public function getMimeType(string $filePath): string
    {
        if (!$this->isFileExists($filePath)) {
            throw new Exception("File $filePath does not exist.", ArchiveConstant::ERROR_NOT_EXISTS);
        }

        return mime_content_type($filePath);
    }

    public function isFileExists(string $filePath): bool
    {
        return file_exists($filePath);
    }

    public function isArchive(string $filePath): bool
    {
        return $this->isTarArchive($filePath)
            || $this->isZipArchive($filePath)
            || $this->isGzipArchive($filePath);
    }

    public function isTarArchive(string $filePath): bool
    {
        return $this->getMimeType($filePath) === static::MIME_TYPE_TAR;
    }

    public function isZipArchive(string $filePath): bool
    {
        return $this->getMimeType($filePath) === static::MIME_TYPE_ZIP;
    }

    public function isGzipArchive(string $filePath): bool
    {
        return $this->getMimeType($filePath) === static::MIME_TYPE_GZIP;
    }
}