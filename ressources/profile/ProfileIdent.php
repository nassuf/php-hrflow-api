<?php

require_once __DIR__.'/../Ident.php';

  /**
   *
   */
  class HrflowProfileIdent extends HrflowIdent
  { }


class ProfileId extends HrflowProfileIdent
{

  function __construct($value)
  {
    $this->name = 'profile_id';
    $this->value = $value;
  }
}


/**
   *
   */
  class ProfileReference extends HrflowProfileIdent
  {

    function __construct($value)
    {
      $this->name = 'profile_reference';
      $this->value = $value;
    }
  }

/**
 *
 */
class ProfileEmail extends HrflowProfileIdent
{

  function __construct($value)
  {
    $this->name = 'profile_email';
    $this->value = $value;
  }
}

 ?>
