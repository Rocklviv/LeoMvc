<?php
namespace system\exceptions;

/**
 * Class HttpException
 * @package system\exceptions
 * @extends LeoException
 * @author Denis Chekirda
 */
class HttpException extends LeoException {

  /**
   * Stores HTTP status code.
   * @var null
   */
  public $statusCode = null;

  /**
   * Construct the exception.
   * @param string $status HTTP status code.
   * @param null $message Error message.
   * @param int $code Error code.
   */
  public function __construct($status, $message = null, $code = 0) {
    $this->statusCode = $status;
    parent::__construct($message, $code);
  }

} 