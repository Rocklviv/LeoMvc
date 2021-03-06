<?php

namespace system\library\Security\Cookies;

/**
 * Interface CookiesInterface
 * @package system\library\Security\Cookies
 */
interface CookiesInterface {
 /**
  * Sets cookie.
  * @param string $key Cookie name.
  * @param array $array
  */
  public static function setCookie($key, array $array);
 /**
  * Gets cookie by name.
  * @param string $key Cookie name.
  * @return array
  */
  public static function getCookie($key);
 /**
  * Destroys cookie by name.
  * @param string $key Cookie name.
  */
  public static function destroy($key);
 /**
  * Validate cookie.
  * @param string $key Cookie name.
  * @return boolean
  */
  public static function validate($key);

}