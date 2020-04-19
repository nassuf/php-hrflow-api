<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Client('ask_d6774338ad024297a8ac5431614513c1');

// POST /profile
$profile_data =[
    "name" => "Hari Seldon",
    "email"=> "harisledon@trantor.trt",
    "address" => "1 rue streeling",
    "info" => [
        "name" => "name info",
        "email" => "tata",
        "phone" => "0202",
        "location" => "somewhere",
        "urls" => [
            "from_resume" => [],
            "linkedin" => "",
            "twitter" => "",
            "facebook" => "",
            "github" => "",
            "picture" => ""],
        "location"=> [
            "text"=>""]],
    "summary" => "test summary",
    "experiences" => [[
        "start" => "15/02/12600",
        "end" => "",
        "title" => "Lead",
        "company" => "Departement de la psychohistoire",
        "location" => [
            "text" => "Trator"],
        "description" => "Developping psychohistoire."
    ]
    ],
    "educations" => [[
        "start" => "12540",
        "end" => "12550",
        "title" => "Diplome d'ingénieur mathematicien",
        "school" => "Université de Hélicon",
        "description" => "Etude des mathematique",
        "location" => [
            "text" => "Hélicon"]
    ]
    ],
    "skills" => ["manual skill", "Creative spirit", "Writing skills", "Communication", "Project management", "French"],
    "languages" => ["arab"],
    "interests" => ["football"],
    "tags" => [],
    "metadatas" => [],
    "labels" => []
] ;
$resp = $client->profile->add_json("cf1d45723e6af357c6232e2e3b5e18e2ebefe5a7", $profile_data, null, 1530607434) ;
var_dump($resp);

// GET /profile/attachments
$profiles = $client->profile->attachment->list("a62ae2d5560fca7b34bb6c0c389a378f99bcdd52",new ProfileId("597b16789ba389cbc67a638d808b8f40220ba988"));
var_dump($profiles);

// GET /profile/tags
$profiles = $client->profile->tag->list("a62ae2d5560fca7b34bb6c0c389a378f99bcdd52",new ProfileId("597b16789ba389cbc67a638d808b8f40220ba988"));
var_dump($profiles);

// GET /profile/metadatas
$profiles = $client->profile->metadata->list("a62ae2d5560fca7b34bb6c0c389a378f99bcdd52",new ProfileId("597b16789ba389cbc67a638d808b8f40220ba988"));
var_dump($profiles);

// GET /profile/parsing
$profiles = $client->profile->parsing->get("a62ae2d5560fca7b34bb6c0c389a378f99bcdd52",new ProfileId("597b16789ba389cbc67a638d808b8f40220ba988"));
var_dump($profiles);

// GET /profile/revealing

// GET /profile/searching
$profiles = $client->profile->searching->get(["a62ae2d5560fca7b34bb6c0c389a378f99bcdd52"]);
var_dump($profiles);

// GET profiles/scoring
$profiles = $client->profile->scoring->get(["a62ae2d5560fca7b34bb6c0c389a378f99bcdd52"], new JobID("a25bc879e774cc508706f6f4ddd8cce036689f3a"), $stage = "new");
var_dump($profiles);
//
//// GET /profile/reasoning
//
//// GET /profile/embedding
$profiles = $client->profile->embedding->get('a62ae2d5560fca7b34bb6c0c389a378f99bcdd52',
    new ProfileId("597b16789ba389cbc67a638d808b8f40220ba988"), ['skills'=>1]);
var_dump($profiles);
//
//// GET /profile/action
////$profiles = $client->profile->feedback->set(new ProfileID("04a25bb3c5af61fcdfa3d67dd9b3b4bd0e6762f0"), new JobID("9e576e1b4da62eaece96cfe247cae6eac73dc1b0"), "yes");
////var_dump($profiles);








