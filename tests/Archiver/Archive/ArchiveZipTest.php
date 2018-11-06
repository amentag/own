<?php

namespace Test\Archiver\Archive;

use PHPUnit\Framework\TestCase;
use Tool\Archiver\Archive\ArchiveZip;

class ArchiveZipTest extends TestCase
{
    /**
     * @var ArchiveZip
     */
    protected $archive;

    protected function setUp()
    {
        parent::setUp();
        $this->archive = new ArchiveZip('');
    }

    public function testAll()
    {
        $this->assertTrue(true);
    }
}