<?php
namespace system\exceptions;

class HttpException extends LeoException {

  public $statusCode;

  public function __construct($status, $message = null, $code = 0) {
    $this->statusCode = $status;
    parent::__construct($message, $code);
  }

} 