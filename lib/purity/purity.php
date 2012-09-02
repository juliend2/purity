<?php

include_once "http.php";
include_once "output.php";
include_once "helpers.php";

session_start();

// PHP's superglobals:
$superglobals = array(
  'get'=>$_GET,
  'post'=>$_POST,
  'files'=>$_FILES,
  'server'=>$_SERVER,
  'session'=>$_SESSION,
  'phpenv'=>$_ENV,
  'cookie'=>$_COOKIE
);

# SETTING BASIC SECURITY (thanks to Limonade PHP)
# _____________________________________________________

# Unsets all global variables set from a superglobal array

/**
 * @access private
 * @return void
 */
function unregister_globals() {
  $args = func_get_args();
  foreach($args as $k => $v)
    if(array_key_exists($k, $GLOBALS)) unset($GLOBALS[$k]);
}

if(ini_get('register_globals')) {
  unregister_globals( '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', 
                      '_ENV', '_FILES');
  ini_set('register_globals', 0);
}

# removing magic quotes

/**
 * @access private
 * @param string $array 
 * @return array
 */
function remove_magic_quotes($array) {
  foreach ($array as $k => $v)
    $array[$k] = is_array($v) ? remove_magic_quotes($v) : stripslashes($v);
  return $array;
}

if (get_magic_quotes_gpc()) {
  $_GET    = remove_magic_quotes($_GET);
  $_POST   = remove_magic_quotes($_POST);
  $_COOKIE = remove_magic_quotes($_COOKIE);
  ini_set('magic_quotes_gpc', 0);
}

if(function_exists('set_magic_quotes_runtime') && get_magic_quotes_runtime()) set_magic_quotes_runtime(false);


