<?php

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

// Takes:
// - $basepath (String) of the app
// - $app_name (String)
// - $view_file (String) , like joy.php
//
// Returns a String of the view's path
function get_view_path($basepath, $app_name, $view_file) {
  return $basepath.$app_name.'/views/'.$view_file;
}

// Takes:
// - $basepath (String) of the app
// - $app_name (String)
// - $view_file (String) , like joy.php
// - $vars (Hash) that we pass to the view
//
// Returns a String of the chunk of HTML
function get_view($basepath, $app_name, $view_file, $vars = null) {
  return get_chunk(get_view_path($basepath, $app_name, $view_file), $vars);
}

