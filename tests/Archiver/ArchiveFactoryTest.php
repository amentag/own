<?php

namespace Test\Archiver;

use Exception;
use PHPUnit\Framework\TestCase;
use Tool\Archiver\Archive\ArchiveGzip;
use Tool\Archiver\Archive\ArchiveTar;
use Tool\Archiver\Archive\ArchiveZip;
use Tool\Archiver\ArchiveFactory;
use Tool\Filesystem\FileInfo;

class ArchiveFactoryTest extends TestCase
{
    /**
     * @var ArchiveFactory
     */
    protected $archiveFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->archiveFactory = new ArchiveFactory();
    }

    public function makeProvider()
    {
        return [
            [FileInfo::MIME_TYPE_GZIP, 'file.csv.gz', ArchiveGzip::class],
            [FileInfo::MIME_TYPE_TAR, 'file.tar', ArchiveTar::class],
            [FileInfo::MIME_TYPE_GZIP, 'file.tar.gz', ArchiveTar::class],
            [FileInfo::MIME_TYPE_ZIP, 'file.zip', ArchiveZip::class],
        ];
    }

    /**
     * @dataProvider makeProvider
     */
    public function testMake(string $mimeType, string $filePath, string $expected)
    {
        $this->assertInstanceOf($expected, $this->archiveFactory->make($mimeType,__DIR__ . '/_files/' . $filePath));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionCode \Tool\Archiver\Archive\ArchiveConstant::ERROR_NOT_MIME_TYPE_ARCHIVE
     */
    public function testMakeArchiveThrowException()
    {
        $this->archiveFactory->make(FileInfo::MIME_TYPE_PLAIN, 'not.exists');
    }
}