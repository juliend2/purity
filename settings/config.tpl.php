<?php

$config = array(
  'baseurl' => 'http://localhost:8888/purity/',
  'basepath' => dirname(__FILE__).'/../',
  'viewspath' => dirname(__FILE__).'/../views/',
  'routes' => array(
    '/' => array('ThingsController', 'index'),
    '/joy' => array('ThingsController', 'joy'),
  ),
  'db' => array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'mysqltest'
  )
);


