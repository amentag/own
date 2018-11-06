<?php

use Tool\Archiver\ArchiveFactory;
use Tool\Archiver\Archiver;
use Tool\Filesystem\FileInfo;

require_once __DIR__ . '/../vendor/autoload.php';

//$sourcePath = __DIR__ . '/../var/source/file.csv';
$archivePath = __DIR__ . '/../var/source/file.csv.tar';
//$archivePath = __DIR__ . '/../var/destination/file2.tar';
//$archivePath = __DIR__ . '/../var/source/debian2.zip';
//$destination

$archiveFactory = new ArchiveFactory();
$fileInfo = new FileInfo();

//
//$info = $fileInfo->getMimeType($sourcePath);

//var_dump($info);exit;

$archiver = new Archiver($archiveFactory, $fileInfo);

//$archive = $archiver->make(FileInfo::MIME_TYPE_TAR, $archivePath);
//$archive->create($sourcePath);

$archive = $archiver->load($archivePath);
$archive->extract(__DIR__ . '/../var/destination');
