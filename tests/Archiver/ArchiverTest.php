<?php

namespace Test\Archiver;

use Exception;
use PHPUnit\Framework\TestCase;
use Tool\Archiver\Archive\ArchiveGzip;
use Tool\Archiver\Archive\ArchiveTar;
use Tool\Archiver\Archive\ArchiveZip;
use Tool\Archiver\ArchiveFactory;
use Tool\Archiver\Archiver;
use Tool\Filesystem\FileInfo;

class ArchiverTest extends TestCase
{
    /**
     * @var Archiver
     */
    protected $archiver;

    protected function setUp()
    {
        parent::setUp();

        $this->archiver = new Archiver(new ArchiveFactory(), new FileInfo());
    }

    public function makeArchiveProvider()
    {
        return [
            ['file.zip', ArchiveZip::class],
            ['file.tar', ArchiveTar::class],
            ['file.tar.gz', ArchiveTar::class],
            ['file.csv.gz', ArchiveGzip::class],
        ];
    }

    /**
     * @dataProvider makeArchiveProvider
     */
    public function testMakeArchive(string $filename, string $expected)
    {
        $archive = $this->archiver->make(__DIR__ . '/_files/' . $filename);

        $this->assertInstanceOf($expected, $archive);
    }

    public function loadArchiveProvider()
    {
        return [
            ['file.csv.gz', ArchiveGzip::class],
            ['file.tar', ArchiveTar::class],
            ['file.tar.gz', ArchiveTar::class],
            ['file.zip', ArchiveZip::class],
        ];
    }

    /**
     * @dataProvider loadArchiveProvider
     */
    public function testLoadArchive(string $archivePath, string $expected)
    {
        $archive = $this->archiver->load(__DIR__ . '/_files/' . $archivePath);

        $this->assertInstanceOf($expected, $archive);
    }

    /**
     * @expectedException     Exception
     * @expectedExceptionCode \Tool\Archiver\Archive\ArchiveConstant::ERROR_NOT_EXISTS
     */
    public function testLoadNotExistsArchiveThrowException()
    {
        $this->archiver->load(__DIR__ . '/_files/not.exists');
    }

    /**
     * @expectedException     Exception
     * @expectedExceptionCode \Tool\Archiver\Archive\ArchiveConstant::ERROR_NOT_ARCHIVE
     */
    public function testLoadNotArchiveThrowException()
    {
        $this->archiver->load(__DIR__ . '/_files/file.csv');
    }

    public function testGetMimeTypes()
    {
        $this->assertEquals([
            FileInfo::MIME_TYPE_7ZIP,
            FileInfo::MIME_TYPE_GZIP,
            FileInfo::MIME_TYPE_RAR,
            FileInfo::MIME_TYPE_TAR,
            FileInfo::MIME_TYPE_ZIP,
        ], $this->archiver->getMimeTypes());
    }
}