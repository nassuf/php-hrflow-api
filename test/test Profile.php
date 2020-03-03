<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Hrflow('ask_cbe04b31bde4c51c6bf0d320d4b285c2');

// GET profiles/scoring
$profiles = $client->profile->scoring->list(["4a2ef05c101ff910354971dd2aa5a01a57a67815"], "5f9f853a87463b52ca7a387f69fc8eef9803a056", $stage = "yes");
var_dump($profiles);


// GET /profile/searching
$profiles = $client->profile->list(["4a2ef05c101ff910354971dd2aa5a01a57a67815"], $stage = "yes");
var_dump($profiles);


// GET /profile/parsing
$profiles = $client->profile->parsing->get("a55aeabef3dfeb917a2706b25b0acc4412ec1dfc","15090b9e0fec8fe4c59edaebfae0b68ff260c29c");
var_dump($profiles);


// GET /profile/attachment
$profiles = $client->profile->attachments->list("4d62c1a3d97a03778b2c47db2604ebe903cf33d7","94ae5f125b85ca8398c015d1ec1900879e846494");
var_dump($profiles);

