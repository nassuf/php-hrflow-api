<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Client('ask_d6774338ad024297a8ac5431614513c1');

// Now, you can use the api, Congrats !

$sources = $client->source->list('python', 1, 1);

var_dump($sources);

$source = $client->source->get('a62ae2d5560fca7b34bb6c0c389a378f99bcdd52');

var_dump($source);

