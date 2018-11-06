<?php

namespace Tool\Sftp;

use Tool\Sftp\Adapter\ClientAdapterInterface;

class Client
{
    /**
     * @var ClientAdapterInterface
     */
    private $client;

    public function __construct(ClientAdapterInterface $client)
    {
        $this->client = $client;
    }

    public function push()
    {
        
    }

    public function pull()
    {

    }
}