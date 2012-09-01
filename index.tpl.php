<?php

include 'lib/purity/purity.php';
include 'lib/database.php';

$env = array(
  // predefined by PHP's environment:
  'php' => $superglobals, 

  'basepath' => dirname(__FILE__).'/',

  // Application URL mappings:
  'mappings' => array(
    '/snippets' => 'snippets/app.php',
    '/' => 'things/app.php',
  ),
  'db' => array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'mysqltest',
  )
);

list($status, $headers, $body) = parse_request($env);
respond($status, $headers, $body);
