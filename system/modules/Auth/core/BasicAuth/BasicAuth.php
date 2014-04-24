<?php
namespace system\modules\Auth\core\BasicAuth;
use \system\modules\Auth\core\BasicAuth\BasicAuthModel;

class BasicAuth {

  private $basicAuthModel = null;

  function __construct() {
    $this->basicAuthModel = new BasicAuthModel();
  }

  public function signIn() {}

  public function signUp() {}

  public function lostPassword() {}

  private function _checkUsers() {}

  private function _checkEmail() {}

}