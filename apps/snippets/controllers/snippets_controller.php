<?php

class SnippetsController {

  public static 
    $app_name = 'snippets';

  public static function index($env) {
    return array(
      200,
      array(),
      get_view(
        $env['basepath'], self::$app_name, 'index.php',
        array('title'=>'Snippets App')
      )
    );
  }

  public static function show($env) {
    return array(
      200,
      array(),
      get_view($env['basepath'], self::$app_name, 'show.php',
        array('snippet'=>'Joie')
      )
    );
  }
}
