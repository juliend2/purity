<?php

/*
 * Takes a DB link OR a DB configuration Hash (with dbname, dbhost, dbuser, dbpass) to connect
 *
 * Returns a DB link (the same as the param, or a newly created one)
 */
function db_or_config($db_or_config) {
  if ($db_or_config instanceof MySQLi) {
    $db = $db_or_config;
    return $db;
  } else {
    $config = $db_or_config;
    return mysqli_connect($config['host'], $config['user'], $config['pass'], $config['name']);
  }
}

/*
 * $db_or_config : DB link or DB configuration Hash (with dbname, dbhost, dbuser, dbpass) to connect
 *
 * Returns an Array of row data as Hashes
 */
function db_find($db_or_config, $statement) {
  $result = mysqli_query($db_or_config, $statement);
  $array = array();
  while ($data = mysqli_fetch_assoc($result)) {
    $array[] = $data;
  }
  mysqli_free_result($result);
  return $array;
}

