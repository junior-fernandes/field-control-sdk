<?php

namespace FieldControl\API;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $client;
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;

        $this->client = new GuzzleClient([
            'base_uri' => 'https://carchost.fieldcontrol.com.br/',
            'verify' => false
        ]);
    }

    public function __call($method, $args)
    {
        if (count($args) < 1) {
            throw new \InvalidArgumentException(
                'Magic request methods require a URI and optional options array'
            );
        }

        $uri = $args[0];

        $options = $args[1] ?? [];

        return $this->request($method, $uri, $options);
    }

    public function request($method, $uri, $options)
    {
        $method = strtoupper($method);

        if($method == 'GET' || $method == 'DELETE') {
            $options['query'] = array_merge(['apikey' => $this->apiKey], $options);
        } elseif($method == 'POST' || $method == 'PUT') {
            $options['form_params'] = array_merge(['apikey' => $this->apiKey], $options);
        }
        $options['http_errors'] = false;

        $response = $this->client->request($method, $uri, $options);

        $jsonResponse = json_decode($response->getBody(), true);
        if (empty($jsonResponse)) {
            return [];
        }

        return (Object)array(
            'code' => $response->getStatusCode(),
            'body' => $jsonResponse,
        );

    }
    
}
