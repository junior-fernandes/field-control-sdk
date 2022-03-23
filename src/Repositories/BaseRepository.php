<?php

namespace FieldControl\Repositories;

use FieldControl\API\Client;

class BaseRepository
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