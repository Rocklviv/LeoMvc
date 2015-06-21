<?php

namespace system\exceptions;
use \system\app\Controller;

/**
 * Class ErrorHandler
 * @package system\exceptions
 * @author Denis Chekirda
 */
class ErrorHandler extends Controller {

  /**
   * Prepares 404 error page.
   * @param $error
   */
  function get404($error) {
    header("HTTP/1.0 404 Not Found");
    $title = 'Error 404 | Page Not Found';
    $this->renderError($title, $error->getMessage());
  }

  /**
   * Prepares 500 error page.
   * @param $error
   */
  function get500($error) {
    header("HTTP/1.0 500 Internal Server Error");
    $title = "Error 500 | Internal Server Error";
    $this->renderError($title, $error->getMessage());
  }

}