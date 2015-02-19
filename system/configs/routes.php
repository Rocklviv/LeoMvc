<?php

/**
 * List of allowed routes.
 * @type array
 */
$routes = array(
  '/' => array(
    'controller' => 'forum',
    'method' => 'index'
  ),
  'forum' => array(
    'controller' => 'forum',
    'method' => 'index'
  ),
  'forum/register' => array(
    'controller' => 'accounts',
    'method' => 'registeration',
    'param' => '\w+'
  )
);