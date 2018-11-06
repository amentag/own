<?php

namespace Test\Filesystem;

use Exception;
use PHPUnit\Framework\TestCase;
use Tool\Filesystem\FileInfo;

class FileInfoTest extends TestCase
{
    /**
     * @var FileInfo
     */
    private $fileInfo;

    protected function setUp()
    {
        parent::setUp();

        $this->fileInfo = new FileInfo();
    }

    public function getMimeTypeProvider()
    {
        return [
            ['file.csv', FileInfo::MIME_TYPE_PLAIN],
            ['file.zip', FileInfo::MIME_TYPE_ZIP],
        ];
    }

    /**
     * @dataProvider getMimeTypeProvider
     */
    public function testGetMimeType(string $filePath, string $expected)
    {
        $this->assertEquals($expected, $this->fileInfo->getMimeType(__DIR__ . '/_files/' . $filePath));
    }

    /**
     * @expectedException     Exception
     * @expectedExceptionCode \Tool\Archiver\Archive\ArchiveConstant::ERROR_NOT_EXISTS
     */
    public function testGetMimeTypeThrowException()
    {
        $this->fileInfo->getMimeType(__DIR__ . '/_files/not.exists');
    }

    public function testIsArchive()
    {
        $this->assertTrue($this->fileInfo->isArchive(__DIR__ . '/_files/file.zip'));
    }

    public function testIsNotArchive()
    {
        $this->assertFalse($this->fileInfo->isArchive(__DIR__ . '/_files/file.csv'));
    }

    /**
     * @expectedException     Exception
     * @expectedExceptionCode \Tool\Archiver\Archive\ArchiveConstant::ERROR_NOT_EXISTS
     */
    public function testIsArchiveThrowException()
    {
        $this->fileInfo->isArchive(__DIR__ . '/_files/not.exists');
    }

    public function testFileExists()
    {
        $this->assertTrue($this->fileInfo->isFileExists(__DIR__ . '/_files/file.csv'));
    }

    public function testFileNotExists()
    {
        $this->assertFalse($this->fileInfo->isFileExists(__DIR__ . '/_files/not.exists'));
    }

    public function testIsZipArchive()
    {
        $this->assertTrue($this->fileInfo->isZipArchive(__DIR__ . '/_files/file.zip'));
    }

    public function testIsNotZipArchive()
    {
        $this->assertFalse($this->fileInfo->isZipArchive(__DIR__ . '/_files/file.tar'));
    }

    /**
     * @expectedException     Exception
     * @expectedExceptionCode \Tool\Archiver\Archive\ArchiveConstant::ERROR_NOT_EXISTS
     */
    public function testIsZipArchiveThrowException()
    {
        $this->fileInfo->isZipArchive(__DIR__ . '/_files/not.exists');
    }

    public function testIsTarArchive()
    {
        $this->assertTrue($this->fileInfo->isTarArchive(__DIR__ . '/_files/file.tar'));
    }

    public function testIsNotTarArchive()
    {
        $this->assertFalse($this->fileInfo->isTarArchive(__DIR__ . '/_files/file.zip'));
    }

    /**
     * @expectedException     Exception
     * @expectedExceptionCode \Tool\Archiver\Archive\ArchiveConstant::ERROR_NOT_EXISTS
     */
    public function testIsTarArchiveThrowException()
    {
        $this->fileInfo->isTarArchive(__DIR__ . '/_files/not.exists');
    }

    public function testIsGzipArchive()
    {
        $this->assertTrue($this->fileInfo->isGzipArchive(__DIR__ . '/_files/file.csv.gz'));
    }

    public function testIsNotGzipArchive()
    {
        $this->assertFalse($this->fileInfo->isGzipArchive(__DIR__ . '/_files/file.zip'));
    }

    /**
     * @expectedException     Exception
     * @expectedExceptionCode \Tool\Archiver\Archive\ArchiveConstant::ERROR_NOT_EXISTS
     */
    public function testIsGzipArchiveThrowException()
    {
        $this->fileInfo->isGzipArchive(__DIR__ . '/_files/not.exists');
    }
}