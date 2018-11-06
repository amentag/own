<?php

namespace Tool\Archiver;

use Exception;
use Tool\Archiver\Archive\ArchiveConstant;
use Tool\Archiver\Archive\ArchiveGzip;
use Tool\Archiver\Archive\ArchiveTar;
use Tool\Archiver\Archive\ArchiveZip;
use Tool\Filesystem\FileInfo;

class ArchiveFactory
{
    /**
     * @return ArchiveGzip|ArchiveTar|ArchiveZip
     * @throws Exception
     */
    public function make(string $mimeType, string $filePath)
    {
        switch ($mimeType) {
            case FileInfo::MIME_TYPE_GZIP :
                try {
                    return new ArchiveTar($filePath);
                } catch (Exception $exception) {
                    return new ArchiveGzip($filePath);
                }
                break;
            case FileInfo::MIME_TYPE_TAR :
                return new ArchiveTar($filePath);
                break;
            case FileInfo::MIME_TYPE_ZIP :
                return new ArchiveZip($filePath);
                break;
            case FileInfo::MIME_TYPE_7ZIP :
            case FileInfo::MIME_TYPE_RAR :
            default :
                throw new Exception($mimeType . ' is not a mime type archive', ArchiveConstant::ERROR_NOT_MIME_TYPE_ARCHIVE);
        }
    }
}