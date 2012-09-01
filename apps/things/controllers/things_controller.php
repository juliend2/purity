<?php

class ThingsController {
  public static 
    $name = 'things';

  public static function index($env) {
    $db = db_or_config($env['db']);
    $data = db_find($db, "SELECT * FROM test");
    return array(
      200,
      array(),
      get_view($env['basepath'], self::$name, 'index.php',
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

