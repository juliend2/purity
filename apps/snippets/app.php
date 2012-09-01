<?php

include_once "controllers/snippets_controller.php";

$routes = array(
  '' => array('SnippetsController', 'index'),
  'show' => array('SnippetsController', 'show')
);
