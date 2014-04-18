<?php
namespace system\app;

use system\library\template\Twig\Autoloader;
/**
 * Class View
 * @package system\app
 */
class View extends Autoloader {

  private $twig;

  static function _register() {
    Autoloader::register();
  }


  /**
   * @param $template
   * @param string $data
   * @return string
   */
  function renderTpl($template, $data = '') {
    self::_register();
    $loader = new \Twig_Loader_Filesystem(TEMPLATE_DIR);

    if (APP_STATE == 'development') {
      $this->twig = new \Twig_Environment($loader, array(
        'debug' => true
      ));
      $this->twig->addExtension(new \Twig_Extension_Debug());
    } else {
      $this->twig = new \Twig_Environment($loader, array(
        'cache' => CACHE,
        'auto_reload' => true
      ));
    }
    //self::_setTranslations();
    if ($data != '') {
      return $this->twig->render($template, $data);
    } else {
      return $this->twig->render($template);
    }
  }

  function clearCache() {
    return $this->twig->clearCacheFiles();
  }

} 