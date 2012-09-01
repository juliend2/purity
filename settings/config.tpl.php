<?php

$config = array(
  'basepath' => 'http://localhost:8888/purity/',
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

