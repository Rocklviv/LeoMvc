<?php
namespace system\app;
use \system\app\View;

/**
 * Class Controller
 * @package system\app
 */
class Controller extends View {

  /**
   * Renders 404 page.
   * @param String $title Page title name.
   * @param String $message Message to show.
   */
  function render404($title, $message) {
    echo $message;
  }

} 