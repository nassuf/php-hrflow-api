<?php
require __DIR__ . '/../vendor/autoload.php';

$client = new \GuzzleHttp\Client(array(
    "base_url" => "https://www.rimstaging.net/sf/public/api/v1.0/",
    "headers"  => ["X-API-KEY"=> "ask_cbe04b31bde4c51c6bf0d320d4b285c2"]),
    "https://www.rimstaging.net/sf/public/api/v1.0/");
$resp = $client->post(
    'https://www.rimstaging.net/sf/public/api/v1.0/profile',
    array(
        'headers' => array('X-API-KEY'=> 'ask_cbe04b31bde4c51c6bf0d320d4b285c2'),
        'form_params' => ['data' => json_encode(['test'=>1])]
    )
);

var_dump(json_decode($resp->getBody(), true));