<?php

/*
 * $config : Hash of configuration
 * $request : Hash with the GET, POST and FILES parameters for this request
 * 
 * returns a response array : status (Integer), headers (Hash) and body (String)
 */
function app($config, $request) {
  // perform the action routing:
  $uri = isset($request['get']['uri']) ? $request['get']['uri'] : '/';
  if (isset($config['routes']) && isset($config['routes'][$uri])) {
    return call_user_func($config['routes'][$uri], $config, $request);
  }
  // 404 error:
  return array(404, array(), "Not Found! :(");
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
function execute($status, $headers, $body) {
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
function return_view($filename, $vars=null){
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

