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
      const PROFILE_PARSE_SUCCESS = 'profile.parse.success';
      const PROFILE_PARSE_ERROR = 'profile.parse.error';
      const PROFILE_SCORE_SUCCESS = 'profile.score.success';
      const PROFILE_SCORE_ERROR = 'profile.score.error';
      const JOB_TRAIN_SUCCESS = 'job.train.success';
      const JOB_TRAIN_ERROR = 'job.train.error';
      const JOB_TRAIN_START = 'job.train.start';
      const JOB_SCORE_SUCCESS = 'job.score.success';
      const JOB_SCORE_ERROR = 'job.score.error';
      const JOB_SCORE_START = 'job.score.start';
      const ACTION_STAGE_SUCCESS = 'action.stage.success';
      const ACTION_STAGE_ERROR = 'action.stage.error';
      const ACTION_RATING_SUCCESS = 'action.rating.success';
      const ACTION_RATING_ERROR = 'action.rating.error';
    }
  /**
   *
   */


 ?>
