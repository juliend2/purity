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


