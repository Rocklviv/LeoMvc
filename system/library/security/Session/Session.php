<?php
namespace system\library\security\Session;

/**
 * Class Session
 *
 * @package system\library\security\Session
 * @implements SessionInterface
 * @author Denis Chekirda
 */
class Session implements SessionInterface {

  /**
   * Initialize session.
   */
  function init() {
    session_start();
  }

  /**
   * Sets session by $key.
   * @param string $key Key for session id.
   * @param string $value Value for session.
   */
  function set($key, $value) {
    if (isset($key) && isset($value)) {
      $_SESSION[$key] = $value;
    }
  }

  /**
   * Gets session value by id.
   * @param string $key Session id key.
   * @return string
   */
  function get($key) {
    $session = '';
    if (array_key_exists($key, $_SESSION) && isset($_SESSION[$key])) {
      $session = $_SESSION[$key];
    }

    return $session;
  }

  /**
   * Destroys session by id.
   * @param string $key Session id key.
   */
  function destroy($key) {
    session_destroy($key);
  }

}