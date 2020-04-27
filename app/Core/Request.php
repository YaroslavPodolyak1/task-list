<?php

namespace App\Core;

use GuzzleHttp\Client;

class Request
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function redirect(array $data)
    {
        $this->client->send($data);
    }
}