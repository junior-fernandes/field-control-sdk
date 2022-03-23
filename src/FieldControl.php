<?php

namespace FieldControl;

use FieldControl\API\Client;
use FieldControl\Repositories\MaterialRepository;

class FieldControl {

    /**
     * @var Client
     */
    protected $client;

    public function __construct(string $apiKey)
    {
        $this->client = new Client($apiKey);
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function materials(): MaterialRepository
    {
        return new MaterialRepository($this->client);
    }    

}