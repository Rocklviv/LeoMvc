<?php
  namespace system;
  use \system\core\Router;
  /**
  * Main application class.
  * @class Application
  */
  class Application {

    private static $config = array();
    private static $routes = array();
    private static $namespaces = array();
    private static $router;

    function __construct() {
      require_once ('core/Autoloader.php');
      self::_getConfigs();
      $loader = new \system\core\Autoloader();
      $loader
              ->prepareNamespace(self::$namespaces)
              ->register();

      self::$router = new Router();
    }

   /**
    * Start method.
    * @method start
    */
    static function start() {
      self::$router->start(self::$routes);
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