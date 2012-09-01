<?php

class ThingsController {
  public static function index($config, $request) {
    $db = db_or_config($config['db']);
    $data = db_find($db, "SELECT * FROM test");
    return array(
      200,
      array(),
      print_r($data, true)
    );
  }

  public static function joy($config, $request) {
    return array(
      301,
      array('Location'=>'http://google.com'),
      ''
    );
  }

}

