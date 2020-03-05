<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Client('ask_cbe04b31bde4c51c6bf0d320d4b285c2');

// POST /job
//$job_json = ["title" => "Data engineer", "description" => "This job is made for Léo Anesi"] ;
//$resp = $client->job->json->add("test", "bdc82215e5eeeaa40608b3d9e2e3b59398811c64", $job_json, "reference job test hrflow", 1530607434);
//
//var_dump($resp);


// GET /jobs/searching
$res = $client->job->list();
var_dump($res);


// GET /jobs/scoring

// GET /job/parsing
$res = $client->job->parsing->get(new JobID("18d6fe0346e1dc744821274a11d845fd4e53795e"));
var_dump($res);
