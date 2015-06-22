<?php

namespace system\modules\Auth\core\BasicAuth;
use \system\library\ActiveRecords\ActiveRecords;

class BasicAuthModel extends ActiveRecords {

  function checkUser($username) {
    $sql = "SELECT username FROM users WHERE username = ?";
    $options = array($username);
    $this->prepare($sql, $options);
    $result = $this->execute();
    var_dump($result);
  }

}