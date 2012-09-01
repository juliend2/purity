<?php

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

// Takes:
// - $status : Integer of the response status code
// - $headers : Hash of the response headers
// - $body : String of the response body
//
// Echoes out the response's headers and body.
//
// Returns nothing
function respond($status, $headers, $body) {
  header("HTTP/1.0 $status"); // For now, we don't put any status string; only the status code
  foreach ($headers as $key => $value) {
    header("$key: $value");
  }
  echo $body;
}


