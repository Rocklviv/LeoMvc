<?php

namespace system\modules\Auth;
use \system\Application;
use \system\modules\Auth\core\BasicAuth\BasicAuth;
use \system\modules\Auth\core\OAuthv2\OAuth;

class Auth {

  // System Configuration.
  private static $cfg = array();
  // Instance that needed to be used.
  private static $instance = null;
  // Required authtype from configuration.
  private static $authType = null;

  
  public static function __construct() {
    $this->cfg = Application::getConfigs();
    $this->authType = $this->cfg["auth-type"] ?: 'basic';
  }

  /**
   * 
   */
  public static function getInstance() {
    if (self::$instance === null) {
      if ($this->authType == 'basic') {
        self::$instance = new BasicAuth();
      } elseif ($this->authType == 'OAuth') {
        self::$instance = new OAuth();
      }
    }
  }

}