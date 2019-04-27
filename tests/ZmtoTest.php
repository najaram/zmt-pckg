<?php

namespace Najaram\Zmto\Tests;

use Mockery\MockInterface;
use Najaram\Zmto\Zmto;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ZmtoTest.
 *
 * @covers \Najaram\Zmto\Zmto
 * @method Zmto make()
 * @method Zmto classInject(array $params = [])
 * @property MockInterface $client
 */
class ZmtoTest extends TestCase
{
    protected $className = Zmto::class;

    /**
     * @dataProvider dataRestaurant
     *
     * @param string $method
     * @param string $uri
     * @param string $data
     * @param array $params
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Najaram\Zmto\Exceptions\ZmtoException
     * @throws \ReflectionException
     */
    public function testMakeRequest(string $method, string $uri, string $data, array $params)
    {
        $zmto = $this->classInject();

        $response = \Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')
            ->andReturn(200)
            ->once();

        $records = sprintf('%s.json', $data);
        $response->shouldReceive('getBody')
            ->andReturn(file_get_contents(__DIR__.'/requests/'.$records))
            ->once();

        $this->client->shouldReceive('request')
            ->with($method, $uri, \Mockery::type('array'))
            ->andReturn($response)
            ->once();

        $data = $zmto->makeRequest($method, $uri, $params);

        $this->assertEquals(18182537, $data['id']);
    }

    /**
     * @return array
     */
    public function dataRestaurant(): array
    {
        return [
            [
                'GET',
                'restaurant',
                'data',
                ['res_id' => 18182537,],
            ],
        ];
    }
}
