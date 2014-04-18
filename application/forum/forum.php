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

    echo $this->render('forum/index.twig', $arr);
  }

} 