<?php

namespace Tool\Sftp\Adapter;

use GuzzleHttp\Client;

class GuzzleAdapter implements ClientAdapterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}