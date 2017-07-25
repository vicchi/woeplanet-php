<?php

if (!($loader = include __DIR__ . '/../vendor/autoload.php')) {
    die('Cannot run unit tests; install dependencies via Composer!');
}

if (!function_exists('curl_version') && !ini_get('allow_url_fopen')) {
    die('Cannot run unit tests; PHP is not compiled with cURL support and allow_url_fopen is disabled - giving up');
}

?>
