<?php

namespace system\modules\Auth;
use \system\Application;
use \system\modules\Auth\core\BasicAuth\BasicAuth;
use \system\modules\Auth\core\OAuthv2\OAuth;

/**
 * Class Auth
 * @package system\modules\Auth
 * @author Denis Chekirda
 */
class Auth {

  /**
   * Stores configuration.
   * @var array
   */
  private static $cfg = array();
  /**
   * Reference to required instance.
   * @var null
   */
  private static $instance = null;
  /**
   * Stores authentication type.
   * @var null|string
   */
  private static $authType = null;


  /**
   *
   */
  public static function __construct() {
    self::$cfg = Application::getConfigs();
    self::$authType = self::$cfg["auth-type"] ?: 'basic';
  }

  /**
   * 
   */
  public static function getInstance() {
    if (self::$instance === null) {
      if (self::$authType == 'basic') {
        self::$instance = new BasicAuth();
      } elseif (self::$authType == 'OAuth') {
        self::$instance = new OAuth();
      }
    }
  }

}