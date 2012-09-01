<?php

class ThingsController {
  public static function index($conf, $request) {
    $db = db_or_config($conf['db']);
    $data = db_find($db, "SELECT * FROM test");
    return array(
      200,
      array(),
      return_view(
        $conf['viewspath'].'things/index.php', 
        array( 'something' => $data)
      )
    );
  }

  public static function joy($conf, $request) {
    return array(
      301,
      array('Location'=>'http://google.com'),
      ''
    );
  }

}

