<?php
  namespace system;
  use \system\core\Router;
  use \system\core\Autoloader;
  /**
  * Main application class.
  * @class Application
  * @author Denis Chekirda
  */
  class Application {

    /**
     * Stores system configuration.
     * @var array
     */
    private static $config = array();
    /**
     * Stores list of allowed routes.
     * @var array
     */
    private static $routes = array();
    /**
     * Stores list of namespaces.
     * @var array
     */
    private static $namespaces = array();
    /**
     * Reference to Router instance.
     * @var null
     */
    private static $router = null;
    /**
     * Stores start time for page generator.
     * @var null
     */
    private static $startTime = null;

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

    /**
     * Starts timer for page generator.
     */
    static function startTimer() {
      $time = microtime();
      $time = explode(' ', $time);
      $time = $time[1] + $time[0];
      self::$startTime = $time;
    }

    /**
     * Ends timer for page generator.
     */
    static function endTimer() {
      $time = microtime();
      $time = explode(' ', $time);
      $time = $time[1] + $time[0];
      $finish = $time;
      $total_time = round(($finish - self::$startTime), 4);
      echo 'Page generated in '.$total_time.' seconds.';
    }

    /**
     * Gets system configuration.
     * @return array
     */
    static function getConfigs() {
      return self::$config;
    }

    /**
     * Gets system configuration.
     * @private
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