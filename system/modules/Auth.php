<?php

namespace system\modules;


class Auth {

  /**
   * Checks is email valid.
   * @param $email String Email.
   * @return bool
   */
  public function checkEmail($email) {
    if ($email === FILTER_VALIDATE_EMAIL) {
      return true;
    } else {
      return false;
    }
  }


}