<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Hrflow('ask_cbe04b31bde4c51c6bf0d320d4b285c2');

// POST /job
$job_json = [];
$job_json["title"] = "Data analyst";
$job_json["description"] = "This job is made for Hrflow" ;
$resp = $client->job->json->add("test", 2, "reference job test hrflow", $job_json, [], [], 1530607434);

var_dump($resp);

//$source = $client->source->get('856898f45d53729b2d461a3e2f22931eaab3ab30');
//
//var_dump($source);

