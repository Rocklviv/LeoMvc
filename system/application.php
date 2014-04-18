<?php
  namespace system;
  use \system\core\Router;
  use \system\core\Autoloader;
  /**
  * Main application class.
  * @class Application
  */
  class Application {

    private static $config = array();
    private static $routes = array();
    private static $namespaces = array();
    private static $router;
    private static $startTime = '';

    /**
     * Start method.
     * @method start
     */
    static function start() {
      self::startTimer();
      require_once ('core/Autoloader.php');
      self::_getConfigs();
      $loader = new Autoloader();
      $loader
        ->prepareNamespace(self::$namespaces)
        ->register();

      self::$router = new Router();
      self::$router->start(self::$routes);
      self::endTimer();
    }

    static function startTimer() {
      $time = microtime();
      $time = explode(' ', $time);
      $time = $time[1] + $time[0];
      self::$startTime = $time;
    }

    static function endTimer() {
      $time = microtime();
      $time = explode(' ', $time);
      $time = $time[1] + $time[0];
      $finish = $time;
      $total_time = round(($finish - self::$startTime), 4);
      echo 'Page generated in '.$total_time.' seconds.';
    }

    static function getConfigs() {
      return self::$config;
    }

    /**
     * @method _getConfigs
     */
    static private function  _getConfigs() {
      if (defined('CONFIG_DIR')) {
        $files = glob(CONFIG_DIR . '*.php');
        foreach($files as $key=>$value) {
          $value = explode('system/', $value);
          require_once($value[1]);
        }
        self::$config = $config ?: array();
        self::$routes = $routes ?: array();
      } else {
        define('CONFIG_DIR', 'system/configs/');
        self::_getConfigs();
      }
    }
  }