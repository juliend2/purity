<?php

/*
 * Takes a DB link OR a DB configuration Hash (with dbname, dbhost, dbuser, dbpass) to connect
 *
 * Returns a DB link (the same as the param, or a newly created one)
 */
function get_db($db_config) {
  return mysqli_connect($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);
}

/*
 * $db_or_config : DB link or DB configuration Hash (with dbname, dbhost, dbuser, dbpass) to connect
 *
 * Returns an Array of row data as Hashes
 */
function db_find($db, $statement) {
  $result = mysqli_query($db, $statement);
  $array = array();
  while ($data = mysqli_fetch_assoc($result)) {
    $array[] = $data;
  }
  mysqli_free_result($result);
  return $array;
}

function db_find_first($db, $statement) {
  $result = mysqli_query($db, $statement);
  $returned = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $returned;
}
