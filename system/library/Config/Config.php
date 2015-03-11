<?php

namespace system\library\Config;

class Config {

  private static $_config = array();

  static function loadConfig() {
    if (defined('CONFIG_DIR')) {
      $files = glob($_SERVER['DOCUMENT_ROOT'] . '/' . CONFIG_DIR . '*.php');
      foreach ($files as $key => $value) {
        require($value);
      }
      self::$_config = $config ?: array();
    }
    return self::$_config;
  }
}