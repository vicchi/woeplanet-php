<?php

namespace Woeplanet\API;

class Client extends AbstractClient {
    const USER_AGENT = 'Woeplanet API PHP wrapper v1.0.0';

    const METHOD_PLACE = 'v1/place';
    const METHOD_PLACETYPE = 'v1/placetype';
    const METHOD_PLACETYPES = 'v1/placetypes';
    const METHOD_COUNTRY = 'v1/country';
    const METHOD_COUNTRIES = 'v1/countries';
    const METHOD_SEARCH = 'v1/search';
    const METHOD_SEARCH_FIELDS = 'v1/search/fields';
    const METHOD_SEARCH_NAMES = 'v1/search/names';
    const METHOD_SEARCH_PREFERRED = 'v1/search/preferred';
    const METHOD_SEARCH_ALTERNATE = 'v1/search/alternate';
    const METHOD_SEARCH_NAME = 'v1/search/name';
    const METHOD_SEARCH_NULL_ISLAND = 'v1/search/null-island';
    const METHOD_META = 'v1/meta';

    private static $defaults = [
        self::METHOD_PLACE => [
            'boundary' => false,
            'superceded' => true
        ],
        self::METHOD_PLACETYPE => [],
        self::METHOD_PLACETYPES => [],
        self::METHOD_COUNTRY => [
            'boundary' => false,
            'superceded' => true
        ],
        self::METHOD_COUNTRIES => [
            'from' => 0,
            'size' => 50,
            'boundary' => false,
            'superceded' => true
        ],
        self::METHOD_SEARCH => [
            'from' => 0,
            'size' => 50,
            'unknown' => false,
            'boundary' => false,
            'superceded' => true,
            'facets' => false,
            'query' => false
        ],
        self::METHOD_SEARCH_FIELDS => [
            'from' => 0,
            'size' => 50,
            'unknown' => false,
            'boundary' => false,
            'superceded' => true,
            'facets' => false,
            'query' => false
        ],
        self::METHOD_SEARCH_NAMES => [
            'from' => 0,
            'size' => 50,
            'unknown' => false,
            'boundary' => false,
            'superceded' => true,
            'facets' => false,
            'query' => false
        ],
        self::METHOD_SEARCH_PREFERRED => [
            'from' => 0,
            'size' => 50,
            'unknown' => false,
            'boundary' => false,
            'superceded' => true,
            'facets' => false,
            'query' => false
        ],
        self::METHOD_SEARCH_ALTERNATE => [
            'from' => 0,
            'size' => 50,
            'unknown' => false,
            'boundary' => false,
            'superceded' => true,
            'facets' => false,
            'query' => false
        ],
        self::METHOD_SEARCH_NAME => [
            'from' => 0,
            'size' => 50,
            'unknown' => false,
            'boundary' => false,
            'superceded' => true,
            'facets' => false,
            'query' => false
        ],
        self::METHOD_SEARCH_NULL_ISLAND => [
            'from' => 0,
            'size' => 50,
            'unknown' => false,
            'boundary' => false,
            'superceded' => true,
            'facets' => false,
            'query' => false
        ],
        self::METHOD_META => []
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

    public function country($iso, $params=[]) {
        $params = $this->buildParams(self::METHOD_COUNTRY, $params);
        $uri = $this->buildUri(self::METHOD_COUNTRY, $iso, $params);
        return $this->getResponse($uri);
    }

    public function countries($params=[]) {
        $params = $this->buildParams(self::METHOD_COUNTRIES, $params);
        $uri = $this->buildUri(self::METHOD_COUNTRIES, NULL, $params);
        return $this->getResponse($uri);
    }

    public function search($params=[]) {
        $params = $this->buildParams(self::METHOD_SEARCH, $params);
        $uri = $this->buildUri(self::METHOD_SEARCH, NULL, $params);
        return $this->getResponse($uri);
    }

    public function searchFields($params=[]) {
        $params = $this->buildParams(self::METHOD_SEARCH_FIELDS, $params);
        $uri = $this->buildUri(self::METHOD_SEARCH_FIELDS, NULL, $params);
        return $this->getResponse($uri);
    }

    public function searchNames($params=[]) {
        $params = $this->buildParams(self::METHOD_SEARCH_NAMES, $params);
        $uri = $this->buildUri(self::METHOD_SEARCH_NAMES, NULL, $params);
        return $this->getResponse($uri);
    }

    public function searchPreferred($params=[]) {
        $params = $this->buildParams(self::METHOD_SEARCH_PREFERRED, $params);
        $uri = $this->buildUri(self::METHOD_SEARCH_PREFERRED, NULL, $params);
        return $this->getResponse($uri);
    }

    public function searchAlternate($params=[]) {
        $params = $this->buildParams(self::METHOD_SEARCH_ALTERNATE, $params);
        $uri = $this->buildUri(self::METHOD_SEARCH_ALTERNATE, NULL, $params);
        return $this->getResponse($uri);
    }

    public function searchName($params=[]) {
        $params = $this->buildParams(self::METHOD_SEARCH_NAME, $params);
        $uri = $this->buildUri(self::METHOD_SEARCH_NAME, NULL, $params);
        return $this->getResponse($uri);
    }

    public function searchNullIsland($params=[]) {
        $params = $this->buildParams(self::METHOD_SEARCH_NULL_ISLAND, $params);
        $uri = $this->buildUri(self::METHOD_SEARCH_NULL_ISLAND, NULL, $params);
        return $this->getResponse($uri);
    }

    public function meta($params=[]) {
        $params = $this->buildParams(self::METHOD_META, $params);
        $uri = $this->buildUri(self::METHOD_META, NULL, $params);
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
