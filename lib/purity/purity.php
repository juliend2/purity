<?php

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

# A. Unsets all global variables set from a superglobal array

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

# B. removing magic quotes

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


# FUNCTIONS
# _____________________________________________________

// Takes an $env Hash
//
// Returns an array with $status (Integer), $headers (Hash) and $body (String)
function parse_request($env) {
  $uri = isset($env['php']['get']['uri']) ? $env['php']['get']['uri'] : '/'; // default is /
  // loop among main route mappings:
  foreach ($env['mappings'] as $map => $app) { 
    // map is found at the beginning of current the URI?
    if (strpos($uri, $map) === 0) { 
      include "{$env['basepath']}apps/$app"; // include the app
      // loop into all the app's routes
      foreach ($routes as $route => $callable) { 
        // current URI matches this route?
        if ("$map/$route" === $uri || ($map === $uri && $route === '')) { 
          return call_user_func($callable, $env); // parse the app's action
        }
      }
    }
  }
  // reached if no route matched:
  return array(404, array(), "<h1>404 Error</h1> Not found.");
}

/*
 * $status : Integer of the response status code
 * $headers : Hash of the response headers
 * $body : String of the response body
 *
 * Echoes out the response's headers and body.
 *
 * Returns nothing
 */
function respond($status, $headers, $body) {
  header("HTTP/1.0 $status"); // For now, we don't put any status string; only the status code
  foreach ($headers as $key => $value) {
    header("$key: $value");
  }
  echo $body;
}

// $filename : String
// $vars : Hash of parameters to pass to the view
//
// Return as String of the processed view
//
// Thanks to Pierre-Luc Thivierge (http://roostermotion.com/) for this cool function 
function get_chunk($filename, $vars=null){
  $content = '';
  ob_start();

  if(!is_null($vars)) {
    extract($vars);
  }

  if (file_exists($filename) === false) {
    throw new Exception("The template $filename does not exist.");
  } else {
    include $filename;
  }

  $content = ob_get_contents();

  ob_end_clean();
  return $content;
}

function get_view_path($basepath, $app_name, $view_file) {
  return $basepath.'apps/'.$app_name.'/views/'.$view_file;
}

function get_view($basepath, $app_name, $view_file, $vars = null) {
  return get_chunk(get_view_path($basepath, $app_name, $view_file), $vars);
}
