<?php
use \system\app\Controller;

/**
 * Class forum
 */
class forum extends Controller {

  /**
   * Index page.
   */
  function index() {
    $arr = array('key' => 'value');

    var_dump($this->render('', $arr));
  }

} 