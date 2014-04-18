<?php

  $routes = array(
    '/' => array(
      'controller' => 'forum',
      'method' => 'index'
    ),
    'forum/' => array(
      'controller' => 'forum',
      'method' => 'index'
    ),
    'forum/register/' => array(
      'controller' => 'accounts',
      'method' => 'register',
      'param' => '\w+'
    )
  );