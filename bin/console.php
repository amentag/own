<?php

use GuzzleHttp\Client as GuzzleClient;
use Tool\Sftp\Adapter\GuzzleAdapter;
use Tool\Sftp\Client as SftpClient;

require_once __DIR__ . '/../vendor/autoload.php';

$guzzlClient = new GuzzleClient([
    'base_uri' => '',
]);

$clientSftp = new SftpClient(new GuzzleAdapter($guzzlClient));

$fileToPush = __DIR__ . '';

