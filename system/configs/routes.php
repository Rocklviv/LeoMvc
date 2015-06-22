<?php

/**
 * List of allowed routes.
 * @type array
 */
$routes = array(
  '/' => array(
    'controller' => 'watermark',
    'method' => 'index'
  ),
  'watermark' => array(
    'controller' => 'watermark',
    'method' => 'index'
  ),
  'accounts/signin' => array(
    'controller' => 'accounts',
    'method' => 'signin',
    'param' => '\w+'
  )
);