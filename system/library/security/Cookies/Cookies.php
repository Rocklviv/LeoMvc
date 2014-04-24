<?php
namespace system\library\security\Cookies;
use \system\library\security\Cookies\CookiesInterface;

/**
 * Class Cookies
 * @package system\library\security\Cookies
 */
class Cookies implements CookiesInterface {

  // Default period of cookie exist.
  private static $time = 86400;
  // Default path for cookie.
  private static $path = "/";
  // Default domain for cookie.
  private static $domain = "";

  /**
   * Sets cookie.
   * @param string $key Cookie name.
   * @param array $array
   */
  public static function setCookie($key, array $array) {
    setcookie($key, json_encode($array), time() + self::$time, self::$path, self::$domain, false);
  }

  /**
   * Gets cookie by name.
   * @param string $key Cookie name.
   * @return array
   */
  public static function getCookie($key) {
    return json_decode(stripcslashes($_COOKIE[$key]), true);
  }

  /**
   * Destroys cookie by name.
   * @param string $key Cookie name.
   */
  public static function destroy($key) {
    setcookie($key, '', time() - 3600, self::$path, self::$domain);
  }

  /**
   * Validate cookie.
   * @param string $key Cookie name.
   * @return boolean
   */
  public static function validate($key) {
    if (isset($_COOKIE[$key])) {
      return true;
    } else {
      return false;
    }
  }

}