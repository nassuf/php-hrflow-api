<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Client('ask_cbe04b31bde4c51c6bf0d320d4b285c2');

// Now, you can use the api, Congrats !

$sources = $client->webhooks->check('https://webhook.site/5a84e0aa-c9e8-4410-948e-322294116eef', 'profile.parsing.success');

var_dump($sources);

