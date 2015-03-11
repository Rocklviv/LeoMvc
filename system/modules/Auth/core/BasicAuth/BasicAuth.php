<?php
namespace system\modules\Auth\core\BasicAuth;
use \system\app\View;
use \system\modules\Auth\core\BasicAuth\BasicAuthModel;
use \system\library\Config\Config;

class BasicAuth extends View {

  private $basicAuthModel = null;
  private $config = array();

  function __construct() {
    $this->config = Config::loadConfig();
    $dsn = $this->config['database-type'] . ':host=' . $this->config['database-host'] . ';dbname='. $this->config['database-name'];
    $this->basicAuthModel = new BasicAuthModel($dsn, $this->config['database-user'], $this->config['database-password']);
  }

  public function signIn() {

  }

  public function signUp() {
    $username = $this->_checkUsers($_REQUEST['username']);
    $password = $_REQUEST['password'];
    #$email = $this->_checkEmail($_REQUEST['inputEmail']);

  }

  public function lostPassword() {

  }

  /**
   * @param $formName
   * @param array $optional
   */
  public function generateForm($formName, $optional = array()) {
    if ($optional) {
      echo $this->renderTpl('accounts/' . $formName . '.twig', $optional);
    } else {
      echo $this->renderTpl('accounts/' . $formName . '.twig');
    }
  }

  private function _checkUsers($username) {
    if ($this->basicAuthModel->checkUser(trim($username))) {
      return true;
    } else {
      return false;
    }
  }

  private function _checkEmail() {

  }

}