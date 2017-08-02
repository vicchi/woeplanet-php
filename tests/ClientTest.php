<?php

namespace Woeplanet\API\Test;

use Woeplanet\API\Client;

class ClientTest extends \PHPUnit\Framework\TestCase {
    protected $client;
    protected static $host;

    public static function setUpBeforeClass() {
        self::$host = getenv('WOEPLANET_API_HOST');
    }
    protected function setUp() {
        $options = [
            'endpoint' => self::$host
        ];
        $this->client = new Client($options);
    }

    public function testInstantiation() {
        $this->assertNotEquals(NULL, $this->client);
        $this->assertObjectHasAttribute('endpoint', $this->client);
    }

    public function testPlace() {
        $woeid = 44418;
        $data = $this->client->place($woeid);
        $body = json_decode($data, true);
        $this->assertNotEquals(NULL, $body);

        $this->assertNotEquals(NULL, $body);
        $this->assertArrayHasKey('properties', $body);
        $this->assertArrayHasKey('woe:woeid', $body['properties']);
        $this->assertEquals(44418, $body['properties']['woe:woeid']);
        $this->assertArrayHasKey('api:status', $body['properties']);
        $this->assertArrayHasKey('code', $body['properties']['api:status']);
        $this->assertEquals(200, $body['properties']['api:status']['code']);
    }

    public function testPlaceType() {
        $id = 7;
        $data = $this->client->placetype($id);
        $body = json_decode($data, true);
        $this->assertNotEquals(NULL, $body);

        $this->assertArrayHasKey('woe:repo', $body);
        $this->assertEquals('woeplanet-meta', $body['woe:repo']);

        $this->assertArrayHasKey('pt:id', $body);
        $this->assertEquals(7, $body['pt:id']);

        $this->assertArrayHasKey('pt:name', $body);
        $this->assertEquals('Town', $body['pt:name']);

        $this->assertArrayHasKey('pt:description', $body);
        $this->assertEquals('A populated settlement such as a city, town, village', $body['pt:description']);

        $this->assertArrayHasKey('pt:shortname', $body);
        $this->assertEquals('Town', $body['pt:shortname']);

        $this->assertArrayHasKey('pt:tag', $body);
        $this->assertEquals('town', $body['pt:tag']);

        $this->assertArrayHasKey('api:status', $body);
        $this->assertArrayHasKey('code', $body['api:status']);
        $this->assertEquals(200, $body['api:status']['code']);
    }

    public function testPlaceTypes() {
        $data = $this->client->placetypes();
        $body = json_decode($data, true);

        $this->assertNotEquals(NULL, $body);

        $this->assertArrayHasKey('api:total', $body);
        $this->assertEquals(31, $body['api:total']);

        $this->assertArrayHasKey('api:hits', $body);
        $this->assertCount(31, $body['api:hits']);

        $this->assertArrayHasKey('api:status', $body);
        $this->assertArrayHasKey('code', $body['api:status']);
        $this->assertEquals(200, $body['api:status']['code']);
    }

    public function testSearchPreferred() {
        $params = [
            'q' => 'london',
            'size' => 5,
            'from' => 0,
            'query' => 'true',
            'iso' => 'GB',
            'placetype' => 7
        ];
        $data = $this->client->searchPreferred($params);
        $body = json_decode($data, true);
        error_log(var_export($body, true));

        $this->assertNotEquals(NULL, $body);

        $this->assertArrayHasKey('api:size', $body);
        $this->assertEquals('5', $body['api:size']);

        $this->assertArrayHasKey('api:hits', $body);
        $this->assertCount(5, $body['api:hits']);

        $this->assertArrayHasKey('api:query', $body);

        $this->assertArrayHasKey('api:status', $body);
        $this->assertArrayHasKey('code', $body['api:status']);
        $this->assertEquals(200, $body['api:status']['code']);

    }
    //
    // public function testMeta() {
    //     $data = $this->client->meta();
    //     $body = json_decode($data, true);
    //     $this->assertNotEquals(NULL, $body);
    //
    //     $this->assertArrayHasKey('woe:repo', $body);
    //     $this->assertEquals('woeplanet-meta', $body['woe:repo']);
    //
    //     $this->assertArrayHasKey('woe:type', $body);
    //     $this->assertEquals('meta', $body['woe:type']);
    //
    //     $this->assertArrayHasKey('woe:maxwoeid', $body);
    //     $this->assertArrayHasKey('woe:places', $body);
    //
    //     $this->assertArrayHasKey('api:status', $body);
    //     $this->assertArrayHasKey('code', $body['api:status']);
    //     $this->assertEquals(200, $body['api:status']['code']);
    // }
}

?>
