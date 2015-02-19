<?php
namespace system\modules\Auth\core\BasicAuth;
use \system\app\View;
use \system\modules\Auth\core\BasicAuth\BasicAuthModel;

class BasicAuth extends View{

  private $basicAuthModel = null;

  function __construct() {
    $this->basicAuthModel = new BasicAuthModel();
  }

  public function signIn() {

  }

  public function signUp() {

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

  private function _checkUsers() {

  }

  private function _checkEmail() {

  }

}