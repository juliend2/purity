Purity
======

*Purity* is my small experiment to create a small PHP framework that tries to
avoid side effects.

It also features a Rack-like interface where an app can be any callable that
receives an env hash and returns a status integer, a header hash and a body string.

Motivation
----------

My motivation with this is to see how far I can go in creating PHP web apps
with the less side effects possible, to increase maintainability an code
reusability.

How it works
------------

### 1. Create an index.php file

For this, use the index.tpl.php file as a template.
With Purity, index.php as a bit like the config.ru file on any Rack app; it should (in that order):

1. include the purity framework (using something like `include 'lib/purity/purity.php'`), 
1. include other libraries (if needed)
1. declare an $env global variable (in which you would have at least a `php`,
   `basepath`, and a `mappings` key.
1. parse the request (using `parse_request`)
1. respond to request (using `respond`)

### 2. Create an app

Each app folder must contain at the very least an app.php file at the root
level, a controller folder containing your controller class. 
app.php MUST contain a $routes (hash) variable that defines routes, like
this:

    $routes = array(
      '' => array('SnippetsController', 'index'),
      'show' => array('SnippetsController', 'show'),
      'new' => array('SnippetsController', 'new'),
      'create' => array('SnippetsController', 'create'),
      'edit' => array('SnippetsController', 'edit'),
      'update' => array('SnippetsController', 'update'),
      'delete' => array('SnippetsController', 'delete'),
    );

The controller actions have to be public static class methods.


