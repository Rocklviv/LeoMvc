<?php
namespace system\app;
use \system\app\View;
use \system\library\security\Session;

/**
 * Class Controller
 * @package system\app
 */
class Controller extends View {

  private $session = '';

  function __construct() {
    $this->session = new Session();
    $this->session->init();
  }

  /**
   * Renders 404 page.
   * @param String $title Page title name.
   * @param String $message Message to show.
   */
  function renderError($title, $message) {
    echo $message;
  }

  /**
   * Renders template or return a json if API mode is on.
   * @param null|String $template
   * @param null|Array $data
   * @return string
   */
  function render($template = null, $data = null) {
    $result = '';
    if (!empty($template)) {
      $result = $this->renderTpl($template, $data);
    } else {
      $result = self::_apiResponse($data);
    }

    return $result;
  }


  /**
   * Returns JSON.
   * @param array $data
   * @return string
   */
  private function _apiResponse($data) {
    $result = new \stdClass();

    foreach ($data as $key=>$value) {
      $result->$key = $value;
    }
    return json_encode($result);
  }

  /**
   * Handle session calls. E.g.: If you want to set a session, call this function like:
   * <code>
   *   $this->handleSession('set', 'user_id', '1');
   * </code>
   *
   * @param string $action Action name that equal method name of Session Class.
   * @param string $key Session id key.
   * @param null|string $value Session value.
   */
  function handleSession($action, $key, $value = null) {
    if (empty($value)) {
      $this->session->$action($key);
    } else {
      $this->session->$action($key, $value);
    }
  }
} 