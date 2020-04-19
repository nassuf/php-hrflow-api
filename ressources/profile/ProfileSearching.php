<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

/**
 *
 */
class ProfileSearching
{
  public function __construct($parent) {
    $this->client = $parent;
  }


  public function get(array $source_ids, $name=null, $email=null, $location_geopoint=[], $location_distance=null, $summary_keywords=[], $text_keywords=[],
                      $experience_keywords=[], $experience_location_geopoint=[], $experience_location_distance=null, $experiences_duration_min=null, $experiences_duration_max=null,
                      $education_keywords=[], $education_location_geopoint=[], $education_location_distance=null, $educations_duration_min=null, $educations_duration_max=null,
                      $skills_dict=[], $languages_dict=[], $interests_dict=null, $labels_dict=null,
                      $date_start="1494539999", $date_end=null, $page=1, $limit=30, $sort_by='date_reception', $order_by='asc')
  {
      if(!$date_end){
            $date_end = time();
      }
      $query = [] ;
      $query["source_ids"]        = json_encode($source_ids);
      $query["name"]              = $name;
      $query["email"]             = $email;
      $query["location_geopoint"] = json_encode($location_geopoint);
      $query["location_distance"] = $location_distance;
      $query["summary_keywords"]  = json_encode($summary_keywords);
      $query["text_keywords"]     = json_encode($text_keywords);

      $query["experience_keywords"]          = json_encode($experience_keywords);
      $query["experience_location_geopoint"] = json_encode($experience_location_geopoint);
      $query["experience_location_distance"] = $experience_location_distance;
      $query["experiences_duration_min"]     = $experiences_duration_min;
      $query["experiences_duration_max"]     = $experiences_duration_max;

      $query["education_keywords"]          = json_encode($education_keywords);
      $query["education_location_geopoint"] = json_encode($education_location_geopoint);
      $query["education_location_distance"] = $education_location_distance;
      $query["educations_duration_min"]     = $educations_duration_min;
      $query["educations_duration_max"]     = $educations_duration_max;
      $query["skills_dict"]                 = json_encode($skills_dict);
      $query["languages_dict"]              = json_encode($languages_dict);
      $query["interests_dict"]              = json_encode($interests_dict);
      $query["labels_dict"]                 = json_encode($labels_dict);
      $query["date_end"]                    = $date_end;
      $query["date_start"]                  = $date_start;
      $query["limit"]                       = $limit;
      $query["page"]                        = $page;
      $query["sort_by"]                     = $sort_by;
      $query["order_by"]                    = $order_by;

      $resp = $this->client->_rest->get("profiles/searching", $query);
      return json_decode($resp->getBody(), true);
    }
}

 ?>
