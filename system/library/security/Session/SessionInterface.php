<?php

namespace system\library\Security\Session;

/**
 * Interface SessionInterface
 * @package system\library\Security\Session
 */
interface SessionInterface {

  /**
   * @return mixed
   */
  function init();

  /**
   * @param string $key Session id.
   * @param string $value Session value.
   */
  function set($key, $value);

  /**
   * @param string $key Session id.
   * @return mixed
   */
  function get($key);

  /**
   * @param string $key Session id.
   */
  function destroy($key);

}