<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Client('ask_cbe04b31bde4c51c6bf0d320d4b285c2');

// Now, you can use the api, Congrats !

$sources = $client->source->list('python');

var_dump($sources);

$source = $client->source->get('856898f45d53729b2d461a3e2f22931eaab3ab30');

var_dump($source);

