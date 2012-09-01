<?php

class ThingsController {
  public static function index($env) {
    $db = db_or_config($env['config']['db']);
    $data = db_find($db, "SELECT * FROM test");
    return array(
      200,
      array(),
      return_view(
        $env['config']['viewspath'].'things/index.php', 
        array( 'something' => $data)
      )
    );
  }

  public static function joy($env) {
    return array(
      301,
      array('Location'=>'http://google.com'),
      ''
    );
  }

}

