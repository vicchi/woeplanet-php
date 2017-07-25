<?php

namespace Woeplanet\API;

class Client extends AbstractClient {
    const USER_AGENT = 'Woeplanet API PHP wrapper v1.0.0';

    const METHOD_PLACE = 'place';
    const METHOD_PLACETYPE = 'placetype';
    const METHOD_PLACETYPES = 'placetypes';
    const METHOD_SEARCH = 'search';
    const METHOD_META = 'meta';
    const METHOD_SCHEMA = 'schema';

    private static $defaults = [
        self::METHOD_PLACE => [
            'boundary' => false
        ],
        self::METHOD_PLACETYPE => [],
        self::METHOD_PLACETYPES => [],
        self::METHOD_SEARCH => [
            'from' => 0,
            'size' => 50,
            'facets' => false,
            'raw_query' => false

        ],
        self::METHOD_META => [],
        self::METHOD_SCHEMA => []
    ];

    public function __construct($options) {
        parent::__construct($options);

    }
    public function place($woeid, $params=[]) {
        $params = $this->buildParams(self::METHOD_PLACE, $params);
        $uri = $this->buildUri(self::METHOD_PLACE, $woeid, $params);
        return $this->getResponse($uri);
    }

    public function placetype($id, $params=[]) {
        $params = $this->buildParams(self::METHOD_PLACETYPE, $params);
        $uri = $this->buildUri(self::METHOD_PLACETYPE, $id, $params);
        return $this->getResponse($uri);
    }

    public function placetypes($params=[]) {
        $params = $this->buildParams(self::METHOD_PLACETYPES, $params);
        $uri = $this->buildUri(self::METHOD_PLACETYPES, NULL, $params);
        return $this->getResponse($uri);
    }

    public function search($params=[]) {
        $params = $this->buildParams(self::METHOD_SEARCH, $params);
        $uri = $this->buildUri(self::METHOD_SEARCH, NULL, $params);
        return $this->getResponse($uri);
    }

    public function meta($params=[]) {
        $params = $this->buildParams(self::METHOD_META, $params);
        $uri = $this->buildUri(self::METHOD_META, NULL, $params);
        return $this->getResponse($uri);
    }

    public function schema($params=[]) {
        $params = $this->buildParams(self::METHOD_SCHEMA, $params);
        $uri = $this->buildUri(self::METHOD_SCHEMA, NULL, $params);
        return $this->getResponse($uri);
    }

    private function buildParams($method, $params) {
        if (NULL === $params || ((gettype($params) === 'array') && empty($params))) {
            $params = [];
        }

        $params = array_replace_recursive(self::$defaults[$method], $params);

        return $params;
    }

    protected function getUserAgent() {
        return self::USER_AGENT;
    }

    protected function getHeaders() {
        return [];
    }
}

?>
