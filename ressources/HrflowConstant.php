<?php

    class HrflowSeniority
    {
      const SENIOR = 'senior';
      const JUNIOR = 'junior';
      const ALL    = 'all';
    }

    class HrflowStage
    {
      const ALL   = null;
      const NEW   = 'NEW';
      const YES   = 'YES';
      const LATER = 'LATER';
      const NO    = 'NO';
    }

    class HrflowSortBy
    {
      const RECEPTION = 'reception';
      const RANKING   = 'ranking';
    }

    class HrflowOrderBy
    {
      const DESC = 'desc';
      const ASC  = 'asc';
    }

    class HrflowField
    {
      const SOURCE_IDS       = 'source_ids';
      const SENIORITY        = 'seniority';
      const JOB_ID           = 'job_id';
      const JOB_REFERENCE    = 'job_reference';
      const STAGE            = 'stage';
      const RATING           = 'rating';
      const DATE_START       = 'date_start';
      const DATE_END         = 'date_end';
      const PAGE             = 'page';
      const LIMIT            = 'limit';
      const SORT_BY          = 'sort_by';
      const ORDER_BY         = 'order_by';
    }

    class HrflowTrainingMetaData
    {
      const JOB_ID           = 'job_id';
      const JOB_REFERENCE    = 'job_reference';
      const STAGE            = 'stage';
      const STAGE_TIMESTAMP  = 'stage_timestamp';
      const RATING           = 'rating';
      const RATING_TIMESTAMP = 'rating_timestamp';
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
