<?php


    class HrflowStage
    {
      const NEW   = 'NEW';
      const YES   = 'YES';
      const LATER = 'LATER';
      const NO    = 'NO';
    }

    class HrflowSortBy
    {
      const DATE_RECEPTION = 'date_reception';
      const LOCATION   = 'location';
      const LOCATION_EXPERIENCE   = 'location_experience';
      const LOCATION_EDUCATION   = 'location_education';
      const SEMANTIC_SCORE   = 'semantic_score';
      const PREDICTIVE_SCORE   = 'predictive_score';
    }

    class HrflowOrderBy
    {
      const DESC = 'desc';
      const ASC  = 'asc';
    }

    class HrflowSearchingFields
    {
      const SOURCE_IDS           = 'source_ids';
      const NAME                 = 'name';
      const EMAIL                = 'email';
      const LOCATION_GEOPOINT    = 'location_geopoint';
      const LOCATION_DISTANCE    = 'location_distance';
      const SUMMARY_KEYWORDS     = 'summary_keywords';
      const TEXT_KEYWORDS        = 'text_keywords';

      const EXPERIENCE_KEYWORDS             = 'experience_keywords';
      const EXPERIENCE_LOCATION_GEOPOINT    = 'experience_location_geopoint';
      const EXPERIENCE_LOCATION_DISTANCE    = 'experience_location_distance';
      const EXPERIENCE_DURATION_MIN         = 'experiences_duration_min';
      const EXPERIENCE_DURATION_MAX         = 'experiences_duration_max';

      const EDUCATION_KEYWORDS            = 'education_keywords';
      const EDUCATION_LOCATION_GEOPOINT   = 'education_location_geopoint';
      const EDUCATION_LOCATION_DISTANCE   = 'education_location_distance';
      const EDUCATION_DURATION_MIN        = 'educations_duration_min';
      const EDUCATION_DURATION_MAX        = 'educations_duration_max';

      const SKILLS_DICT       = 'skills_dict';
      const LANGUAGES_DICT    = 'languages_dict';
      const INTERESTES_DICT   = 'interests_dict';
      const LABELS_DICT       = 'labels_dict';

      const DATE_START     = 'date_start';
      const DATE_END       = 'date_end';
      const PAGE           = 'page';
      const LIMIT          = 'limit';
      const SORT_BY        = 'sort_by';
      const ORDER_BY       = 'order_by';
    }


class HrflowScoringFields
{
    const SOURCE_IDS           = 'source_ids';
    const JOB_ID               = 'job_id';
    const STAGE                = 'stage';
    const USE_AGENT            = 'use_agent';
    const NAME                 = 'name';
    const EMAIL                = 'email';
    const LOCATION_GEOPOINT    = 'location_geopoint';
    const LOCATION_DISTANCE    = 'location_distance';
    const SUMMARY_KEYWORDS     = 'summary_keywords';
    const TEXT_KEYWORDS        = 'text_keywords';

    const EXPERIENCE_KEYWORDS             = 'experience_keywords';
    const EXPERIENCE_LOCATION_GEOPOINT    = 'experience_location_geopoint';
    const EXPERIENCE_LOCATION_DISTANCE    = 'experience_location_distance';
    const EXPERIENCE_DURATION_MIN         = 'experiences_duration_min';
    const EXPERIENCE_DURATION_MAX         = 'experiences_duration_max';

    const EDUCATION_KEYWORDS            = 'education_keywords';
    const EDUCATION_LOCATION_GEOPOINT   = 'education_location_geopoint';
    const EDUCATION_LOCATION_DISTANCE   = 'education_location_distance';
    const EDUCATION_DURATION_MIN        = 'educations_duration_min';
    const EDUCATION_DURATION_MAX        = 'educations_duration_max';

    const SKILLS_DICT       = 'skills_dict';
    const LANGUAGES_DICT    = 'languages_dict';
    const INTERESTES_DICT   = 'interests_dict';
    const LABELS_DICT       = 'labels_dict';

    const DATE_START     = 'date_start';
    const DATE_END       = 'date_end';
    const PAGE           = 'page';
    const LIMIT          = 'limit';
    const SORT_BY        = 'sort_by';
    const ORDER_BY       = 'order_by';
}

    class HrflowEvents
    {
      const PROFILE_PARSING_SUCCESS = 'profile.parsing.success';
      const PROFILE_PARSING_ERROR = 'profile.parsing.error';
      const PROFILE_EMBEDDING_SUCCESS = 'profile.embedding.success';
      const PROFILE_EMBEDDING_ERROR = 'profile.embedding.error';
      const JOB_PARSING_SUCCESS = 'job.parsing.success';
      const JOB_PARSING_ERROR = 'job.parsing.error';
      const JOB_EMBEDDING_SUCCESS = 'job.embedding.success';
      const JOB_EMBEDDING_ERROR = 'job.embedding.error';
      const ACTION_STAGE_SUCCESS = 'action.stage.success';
      const ACTION_STAGE_ERROR = 'action.stage.error';
      const ACTION_RATING_SUCCESS = 'action.rating.success';
      const ACTION_RATING_ERROR = 'action.rating.error';
    }
  /**
   *
   */


 ?>
