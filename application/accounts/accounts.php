<?php

use \system\app\Controller;

class accounts extends Controller {

  function __construct() {
    parent::__construct();
  }

  function register($id) {
    echo 'register ' . $id;
  }

} 