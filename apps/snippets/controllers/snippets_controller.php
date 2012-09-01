<?php

class SnippetsController {

  public static 
    $name = 'snippets';

  public static function index($env) {
    return array(
      200,
      array(),
      get_view($env['basepath'], self::$name, 'index.php',
        array('title'=>'Snippets App')
      )
    );
  }

  public static function show($env) {
    return array(
      200,
      array(),
      get_view($env['basepath'], self::$name, 'show.php',
        array('snippet'=>'Joie')
      )
    );
  }

}
