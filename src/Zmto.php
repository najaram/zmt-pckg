<?php

namespace Najaram\Zmto;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Najaram\Zmto\Exceptions\ZmtoException;

class Zmto
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Zmto constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @return mixed
     * @throws ZmtoException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function makeRequest(string $method, string $uri, array $parameters = [])
    {
        try {
            $response = $this->client->request($method, $uri, $this->getParams($parameters));

            return $this->getResponse($response);
        } catch (BadResponseException $exception) {
            throw $exception;
        }
    }

    /**
     * @param array $params
     * @return array
     */
    protected function getParams(array $params = []): array
    {
        return [
            'query'   => $params,
            'headers' => [
                'Accept'   => 'application/json',
                'user-key' => env('ZOMATO_API'),
            ],
        ];
    }

    /**
     * @param $response
     * @return mixed
     * @throws ZmtoException
     */
    public function getResponse($response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new ZmtoException('An error occured.');
        }

        $data = json_decode($response->getBody(), true);

        return $data;
    }
}
