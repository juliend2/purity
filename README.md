Purity
======

*Purity* is my small experiment to create a PHP framework that tries to embrace
the concept of [pure functions](http://en.wikipedia.org/wiki/Pure_function).

It also features a Rack-like interface where an app can be any callable that
receives an env hash and returns a status integer, a header hash and a body string.

Motivation
----------

My motivation with this is to see how far I can go in creating PHP web apps
with the less side effects possible, to increase maintainability an code
reusability.


