<?php

namespace system\exceptions;
use \system\app\Controller;

/**
 * Class ErrorHandler
 * @package system\exceptions
 */
class ErrorHandler extends Controller {

  /**
   * Prepare 404 page.
   * @param $r
   */
  function get404($r) {
    $title = '404 | Page Not Found';
    $this->render404($title, $r->getMessage());
  }

  function get500($error) {
  	$title = '500 | Internal Server Error';
  	$this->render404($title, $error->getMessage());
  }

} 