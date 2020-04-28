<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

/**
 *
 */
  class ProfileScoring
  {

    public function __construct($parent) {
      $this->client = $parent;
    }


    public function get(array $source_ids, $job_id=null, $stage=null, $use_agent=null, $name=null, $email=null, $location_geopoint=[], $location_distance=null, $summary_keywords=[], $text_keywords=[],
                        $experience_keywords=[], $experience_location_geopoint=[], $experience_location_distance=null, $experiences_duration_min=null, $experiences_duration_max=null,
                        $education_keywords=[], $education_location_geopoint=[], $education_location_distance=null, $educations_duration_min=null, $educations_duration_max=null,
                        $skills_dict=[], $languages_dict=[], $interests_dict=null, $labels_dict=null,
                        $date_start="1494539999", $date_end=null, $page=1, $limit=30, $sort_by='date_reception', $order_by='asc')
    {
      if(!$date_end){
          $date_end = time();
      }
      $params = [] ;
      $params["source_ids"]        = json_encode($source_ids);
      $params["job_id"]            = $job_id;
      $params["stage"]             = $stage;
      $params["use_agent"]         = $use_agent;
      $params["name"]              = $name;
      $params["email"]             = $email;
      $params["location_geopoint"] = json_encode($location_geopoint);
      $params["location_distance"] = $location_distance;
      $params["summary_keywords"]  = json_encode($summary_keywords);
      $params["text_keywords"]     = json_encode($text_keywords);

      $params["experience_keywords"]          = json_encode($experience_keywords);
      $params["experience_location_geopoint"] = json_encode($experience_location_geopoint);
      $params["experience_location_distance"] = $experience_location_distance;
      $params["experiences_duration_min"]     = $experiences_duration_min;
      $params["experiences_duration_max"]     = $experiences_duration_max;

      $params["education_keywords"]          = json_encode($education_keywords);
      $params["education_location_geopoint"] = json_encode($education_location_geopoint);
      $params["education_location_distance"] = $education_location_distance;
      $params["educations_duration_min"]     = $educations_duration_min;
      $params["educations_duration_max"]     = $educations_duration_max;
      $params["skills_dict"]                 = json_encode($skills_dict);
      $params["languages_dict"]              = json_encode($languages_dict);
      $params["interests_dict"]              = json_encode($interests_dict);
      $params["labels_dict"]                 = json_encode($labels_dict);
      $params["date_end"]                    = $date_end;
      $params["date_start"]                  = $date_start;
      $params["limit"]                       = $limit;
      $params["page"]                        = $page;
      $params["sort_by"]                     = $sort_by;
      $params["order_by"]                    = $order_by;

      $resp = $this->client->_rest->get("profiles/scoring", $params);
      return json_decode($resp->getBody(), true);
    }
  }

 ?>
