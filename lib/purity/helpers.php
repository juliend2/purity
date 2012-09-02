<?php

function e($value) {
  echo $value;
}

function pr() {
  $args = func_get_args();
  foreach ($args as $val) {
    e('<pre>');
    print_r($val);
    e('</pre>');
  }
}
