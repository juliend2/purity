<?php

include 'lib/framework.php';
include 'lib/database.php';
include 'controllers/things_controller.php';
include 'settings/config.php';

list($status, $headers, $body) = parse_request($config, array(
  'get'=>$_GET, 
  'post'=>$_POST, 
  'files'=>$_FILES
));

execute($status, $headers, $body);
