<?php

namespace application\watermark;
use \system\app\Controller;

class watermark extends Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    if ($this->handleSession('get', 'isWTadmin')) {
      $this->dashboard();
    } else {
      $acc = new \application\accounts\accounts();
      $acc->login();
    }
  }

  function dashboard() {
    var_dump($this->handleSession('get', 'isWTadmin'));
  }

}