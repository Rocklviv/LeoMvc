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
      if (array_key_exists('username', $_REQUEST) &&
          array_key_exists('password', $_REQUEST) &&
          array_key_exists('inputEmail', $_REQUEST))
      {
        if ($this->_authType->signUp()) {
          $title = array('title' => 'Sign UP Successful');
          echo $this->renderTpl('accounts/signupSuccess.twig', $title);
        } else {
          $title = array('title' => '');
          echo $this->renderTpl('accounts/signupFailure.twig', $title);
        }
      }

    } else {
      $this->_authType->generateForm('register', $title);
    }
  }

  function login() {
    $this->_authType->generateForm('login');
  }

  function signin() {
    $user = 'Admin';
    $pass = 'Rocklviv85';
    if (isset($_REQUEST) && array_key_exists('username', $_REQUEST)) $username = $_REQUEST['username'];
    if (isset($_REQUEST) && array_key_exists('password', $_REQUEST)) $username = $_REQUEST['password'];

    if ($username == $user && $password == $pass) {
      $this->handleSession('set', 'isWTadmin', rand());
      @header('Location: /watermark/index', 302);
    }
  }

}