<?php
namespace application\accounts;
use \system\app\Controller;
use \system\modules\Auth\Auth;

class accounts extends Controller {

  protected $_auth = null;

  protected $_authType = null;

  function __construct() {
    $this->_auth = new Auth();
    $this->_auth->getInstance();
    $this->_authType = $this->_auth->instance();
  }

  function registeration() {
    $title = array('title'=>'Sign UP at LeoForum');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $title = array('title' => 'Sign UP Successful');
      echo $this->renderTpl('accounts/signupSuccess.twig', $title);
    } else {
      $this->_authType->generateForm('register', $title);
    }
  }

  function login() {
    $this->_authType->generateForm('login');
  }

}