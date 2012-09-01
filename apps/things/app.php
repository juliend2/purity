<?php

include_once "controllers/things_controller.php";

$routes = array(
  '' => array('ThingsController', 'index'),
  'joy' => array('ThingsController', 'joy')
);

