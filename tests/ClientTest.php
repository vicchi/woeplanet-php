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

        $this->assertArrayHasKey('api:placetype', $body);

        $this->assertArrayHasKey('id', $body['api:placetype']);
        $this->assertEquals(7, $body['api:placetype']['id']);

        $this->assertArrayHasKey('name', $body['api:placetype']);
        $this->assertEquals('Town', $body['api:placetype']['name']);

        $this->assertArrayHasKey('description', $body['api:placetype']);
        $this->assertEquals('A populated settlement such as a city, town, village', $body['api:placetype']['description']);

        $this->assertArrayHasKey('shortname', $body['api:placetype']);
        $this->assertEquals('Town', $body['api:placetype']['shortname']);

        $this->assertArrayHasKey('tag', $body['api:placetype']);
        $this->assertEquals('town', $body['api:placetype']['tag']);

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

        $this->assertArrayHasKey('api:placetypes', $body);
        $this->assertCount(31, $body['api:placetypes']);

        $this->assertArrayHasKey('api:status', $body);
        $this->assertArrayHasKey('code', $body['api:status']);
        $this->assertEquals(200, $body['api:status']['code']);
    }

    public function testSearch() {
        $params = [
            'preferred' => 'london',
            'size' => 5,
            'from' => 0,
            'raw-query' => 'true',
            'iso' => 'GB',
            'placetype' => 7
        ];
        $data = $this->client->search($params);
        $body = json_decode($data, true);
        $this->assertNotEquals(NULL, $body);
        error_log(var_export($body, true));

        $this->assertArrayHasKey('api:size', $body);
        $this->assertEquals('5', $body['api:size']);

        $this->assertArrayHasKey('api:hits', $body);
        $this->assertCount(5, $body['api:hits']);

        $this->assertArrayHasKey('api:raw_query', $body);

        $this->assertArrayHasKey('api:status', $body);
        $this->assertArrayHasKey('code', $body['api:status']);
        $this->assertEquals(200, $body['api:status']['code']);

    }

    public function testMeta() {
        $data = $this->client->meta();
        $body = json_decode($data, true);
        $this->assertNotEquals(NULL, $body);

        $this->assertArrayHasKey('woe:repo', $body);
        $this->assertEquals('woeplanet-meta', $body['woe:repo']);

        $this->assertArrayHasKey('woe:type', $body);
        $this->assertEquals('meta', $body['woe:type']);

        $this->assertArrayHasKey('woe:maxwoeid', $body);
        $this->assertArrayHasKey('woe:places', $body);

        $this->assertArrayHasKey('api:status', $body);
        $this->assertArrayHasKey('code', $body['api:status']);
        $this->assertEquals(200, $body['api:status']['code']);
    }

    public function testSchema() {
        $data = $this->client->schema();
        $body = json_decode($data, true);

        $this->assertArrayHasKey('api:schema', $body);

        $this->assertArrayHasKey('api:status', $body);
        $this->assertArrayHasKey('code', $body['api:status']);
        $this->assertEquals(200, $body['api:status']['code']);
    }
}

?>
