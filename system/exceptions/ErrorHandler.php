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
    $this->renderError($title, $r->getMessage());
  }

  /**
   * Prepare error 500 message.
   * @param $message
   */
  function get500($message) {
    $title = "Error 500 | Internal Server Error";
    $this->renderError($title, $message->getMessage());
  }

} 