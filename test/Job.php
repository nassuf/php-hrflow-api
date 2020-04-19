<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Client('ask_d6774338ad024297a8ac5431614513c1');

// POST /job
$job_json = ["title" => "Data engineer", "description" => "This job is made for you"] ;
//$resp = $client->job->add_json("test", "a5dde54d7aa9a2ce6d3b11250aaa139cda3c9add", "123123123", null,
//    null, 1530607434, $job_json);
//
//var_dump($resp);


//// GET /jobs/searching
//$res = $client->job->searching->get();
//var_dump($res);


// GET /jobs/scoring

//// GET /job/parsing
//$res = $client->job->parsing->get(new JobID("399329b780feda71db57957d24ec9ee87d3b55a9"));
//var_dump($res);

// GET /job/embedding
$res = $client->job->embedding->get(new JobID("399329b780feda71db57957d24ec9ee87d3b55a9"));
var_dump($res);
