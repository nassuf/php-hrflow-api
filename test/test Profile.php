<?php
require __DIR__ . '/../vendor/autoload.php';

// Authentication to api
$client = new Client('ask_cbe04b31bde4c51c6bf0d320d4b285c2');

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
$resp = $client->profile->json->add("4d62c1a3d97a03778b2c47db2604ebe903cf33d7", $profile_data, null, 1530607434) ;
var_dump($resp);

// GET /profile/attachment
$profiles = $client->profile->attachments->list("4d62c1a3d97a03778b2c47db2604ebe903cf33d7",new ProfileID("94ae5f125b85ca8398c015d1ec1900879e846494"));
var_dump($profiles);

// GET /profile/parsing
$profiles = $client->profile->parsing->get("a55aeabef3dfeb917a2706b25b0acc4412ec1dfc",new ProfileID("15090b9e0fec8fe4c59edaebfae0b68ff260c29c"));
var_dump($profiles);

// GET /profile/revealing

// GET /profile/searching
$profiles = $client->profile->list(["39b9bdb43f044ca12f04dffc8fe9ff3bd246e040"]);
var_dump($profiles);

// GET profiles/scoring
$profiles = $client->profile->scoring->list(["4a2ef05c101ff910354971dd2aa5a01a57a67815"], new JobID("5f9f853a87463b52ca7a387f69fc8eef9803a056"), $stage = "yes");
var_dump($profiles);

// GET /profile/reasoning

// GET /profile/embedding






