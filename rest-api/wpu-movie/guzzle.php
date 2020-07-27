<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'http://omdbapi.com', [
   'query' => [
      'apikey' => 'bcd11129',
      's' => 'harry potter'
   ]
]);
