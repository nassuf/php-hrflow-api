### Hrflow API PHP
🐘 Hrflow API PHP Wrapper

-------------
## Installation with composer

```
composer require hrflow/hrflow-php-api
```

## Authentication

To authenticate against the api, get your API SECRET KEY from your hrflow
dashboard:
![findApiSecret](secretLocation.png)

Then create a new `Hrflow` object with this key:
```php
require __DIR__ . '/vendor/autoload.php';

// Authentication to api
$client = new Client('yourShinyKey');

// Now, you can use the api, Congrats !

```

## API Overview

```php
require __DIR__ . '/vendor/autoload.php';

// Authentication to api
$client = new Client('yourShinyKey');

$profile = $client->profile->parsing->get("a62ae2d5560fca7b34bb6c0c389a378f99bcdd52",new ProfileId("597b16789ba389cbc67a638d808b8f40220ba988"));
$name = $profile['name']['text'];
$profile_id = $profile['profile_id'];


echo "Profile '$profile_id' is named '$name', a beautiful name actually";
```
# Errors
If an error occurs while an operation an exception of type `HrflowApiException` is raised.

# Profile the ID or the reference
Methods that needs an profile id or reference takes a `ProfileID` or a `ProfileReference`, they are interchangeable.
  ```php
  $profile_id = new ProfileID('102b6aa635fnf8ar70e7888ee63c0jde0c753dtg');
  $profile_reference = new ProfileReference('reference01');
  $source_id = '34566aa635fnrtar70e7568ee6345jde0c75ert4';
  // This:
  $client->profile->parsing->get($profile_id, $source_id);
  // Works as much as:
  $client->profile->parsing->get($profile_reference, $source_id);
  ```

# Job the ID or the reference
It's works the same way as profile.

## Methods & Resources
  `*_id` and `*_reference` are marked as `*_ident` for simplicity.

# jobs
  * Get all job for given team account :
    ```php
    $jobs = $client->job->searching->get();

    ```
    * Get job's information associated with job id :
    ```php
    $job = $client->job->parsing->get(new JobID("399329b780feda71db57957d24ec9ee87d3b55a9"));
    ```
# Profiles
  * Retrieve the profiles information associated with some source ids :
    ```php
    $profiles = $client->profile->searching->get(array $source_ids, $name=null, $email=null, $location_geopoint=[], $location_distance=null, $summary_keywords=[], $text_keywords=[],
                        $experience_keywords=[], $experience_location_geopoint=[], $experience_location_distance=null, $experiences_duration_min=null, $experiences_duration_max=null,
                        $education_keywords=[], $education_location_geopoint=[], $education_location_distance=null, $educations_duration_min=null, $educations_duration_max=null,
                        $skills_dict=[], $languages_dict=[], $interests_dict=null, $labels_dict=null,
                        $date_start="1494539999", $date_end=null, $page=1, $limit=30, $sort_by='date_reception', $order_by='asc');
    ```
  * Retrieve list of profile'score for given job :
    ```php
    $client->profile->scoring->get(array $source_ids, $job_id=null, $stage=null, $use_agent=null, $name=null, $email=null, $location_geopoint=[], $location_distance=null, $summary_keywords=[], $text_keywords=[],
                          $experience_keywords=[], $experience_location_geopoint=[], $experience_location_distance=null, $experiences_duration_min=null, $experiences_duration_max=null,
                          $education_keywords=[], $education_location_geopoint=[], $education_location_distance=null, $educations_duration_min=null, $educations_duration_max=null,
                          $skills_dict=[], $languages_dict=[], $interests_dict=null, $labels_dict=null,
                          $date_start="1494539999", $date_end=null, $page=1, $limit=30, $sort_by='date_reception', $order_by='asc');
   ```
  * Add a resume to a sourced id :
    ```php
    $client->profile->add_file(string $source_id, $profile_file, $profile_content_type=null, $profile_reference=null, $timestamp_reception=null, $profile_labels=[], $profile_tags=[], $profile_metadatas=[], $sync_parsing=0);
    ```
  `$profile_file` is a binary: $profile_file = fopen("/path/2/file", "rb");

  
  * Add a json to a sourced id :
    ```php
    $client->profile->add_json($source_id, $profile_data, $profile_reference, $timestamp_reception, $profile_labels=[], $profile_tags=[], $profile_metadatas=[]);
    ```
  `$profile_data` is an array like this:
    ```php
    $profileData = {
    "name"    => "Harry Potter",
    "email"   => "harry.potter@gmail.com",
    "address" => "1 rue streeling",
    "info"    => {
        "name"     => "Harry Potter",
        "email"    => "harry.potter@gmail.com",
        "phone"    => "0202",
        "location" => "somewhere",
        "urls"     => {
            "from_resume" => [],
            "linkedin"    => "",
            "twitter"     => "",
            "facebook"    => "",
            "github"      => "",
            "picture"     => ""},
        "location"        => {"text" => ""}},
    "summary"     => "test summary",
    "experiences" => [{
        "start"       => "15/02/1900",
        "end"         => "",
        "title"       => "Lead",
        "company"     => "Mathematic Departement",
        "location"    => {"text" => "Paris"},
        "description" => "Developping."
        }],
    "educations" => [{
        "start"       => "12540",
        "end"         => "12550",
        "title"       => "Mathematicien",
        "school"      => "University",
        "description" => "Description",
        "location"    => {"text" => "Scotland"}
    }],
    "skills"      => ["manual skill", "Creative spirit", "Writing skills", "Communication"],
    "languages"   => ["english"],
    "interests"   => ["football"],
    "tags"        => [],
    "metadatas"   => [],
    "labels"      => ["stage":"yes","job_id":"job_id"]
  } ;
    ```
  * Add all resume from a directory to a sourced id, use `$recurs` to enable recursive mode :
    ```php
    add_folder(string $source_id, string $dir_path, bool $recurs=false, $timestamp_reception=null, $sync_parsing=0)
    ```
  It returns an array like: `result[filename] = server_reponse`.
  Can throw `HrflowApiProfileUploadException`
  * Get the profile information associated with both profile id and source id :
    ```php
    $client->profile->parsing->get($source_id, $profile_ident);
    ```
  * Retrieve the profile documents associated with both profile id and source id :
    ```php
    $client->profile->attachment->list($source_id, $profile_ident);
    ```
  * Retrieve the profile tags associated with both profile id and source id :
    ```php
    $client->profile->tag->list($source_id, $profile_ident);
    ```
  * Retrieve the profile metadata associated with both profile id and source id :
    ```php
    $client->profile->metadata->list($source_id, $profile_ident);
    ```
  * Retrieve the profile parsing data associated with both profile id and source id :
     ```php
     $client->profile->parsing->get($profile_ident, $source_ident);
     ```
  * Reveal the profile interpretability data associated with both profile id and source id related with the filter :
      ```php
      $client->profile->revealing->get($profile_ident, $job_ident, $source_id);
      ```
* # Sources
  * Get all sources for given team account:
    ```php
    $client->source->list('python', 1, 1);
    ```
  * Get the source information associated with source id:
     ```php
     $client->source->get($source_id);
     ```
* # webhooks
This package supplies webhooks support as well.
  * Check for webhooks integration:
    ```php
    $client->webhooks->check();
    ```
  * Set an handler for an event (listed with HrflowEvents constants)
    ```php
    $client->webhooks->setHandler($eventName, $callback);
    ```
  * Check if the event has an handler
    ```php
    $client->webhooks->isHandlerPresent($eventName);
    ```
  * Remove handler for an event
    ```php
    $client->webhooks->removeHandler($eventName);
    ```
  * Handle the incoming webhooks request, you need to put as argument HTTP_RIMINDER_SIGNATURE as an argument.
    ```php
    $client->webhooks->handle($encoded_datas);
    ```
  * Example on how to handle webhooks

    ```php
  	$client = new Client('api_key', 'webhook_key');

  	// Set an handler for webhooks event.
    // Event name argument is actually not mandatory
  	$callback = function($webhook_data, $event_name) {
      print($event_name);
      var_dump($webhook_data);
      }
      // HrflowEvents contants can be use as well as string for event name
      // for example here HrflowEvents::PROFILE_PARSE_SUCCESS can be replaced
      // by 'profile.parse.success'
  	$client->webhooks->setHandler(HrflowEvents::PROFILE_PARSE_SUCCESS, $callback);

  	// Get the header of the request sent by the webhook.
  	$encoded_header = [HTTP-RIMINDER-SIGNATURE => 'some encoded datas'];

      // Handle the webhook
  	$client->webhooks->handle($encoded_header);
    ```
* # Constants
  * `HrflowFields` Contains to fill profile's `args` array for /profiles constants.
  * `HrflowSortBy`  Contains sorting options constants.
  * `HrflowOrderBy`  Contains order options constants.
  * `HrflowEvents` Constains event name for webhooks
* # Exception
  * `HrflowApiException` parent of all thrown exception. Thrown when an error occurs.
  * `HrflowApiResponseException` thrown when response http code is not a valid one.
    * `getHttpCode()` to get the http code of the response.
    * `getHttpMessage()` to get the reason of response error.
  * `HrflowApiArgumentException` thrown when an invalid argument is pass to a method
  * `HrflowApiProfileUploadException` thrown when an error occurs during file upload.
    * `getFailedFiles()` to get not sended files list.
    * `getFailedFilesWithTheirExp()` to get not sended files with their exception (like: `exception_occured_during_tranfert = failed_file_list[filename]`)
    * `getSuccefullySendedFiles()` to get successfuly sended files with their response from server (like: `server_reponse_for_sucessful_upload = sucess_file_list[filename]`)

For details about method's arguments and return values see [api's documentation](https://developers.hrflow.ai)
