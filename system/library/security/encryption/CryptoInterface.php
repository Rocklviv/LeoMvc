<?php
namespace system\library\security\encryption;

/**
 * Interface CryptoInterface
 * @package system\library
 */
interface CryptoInterface {

  /**
   * @param $key
   */
  public function __construct($key);

  /**
   * Encrypts required string.
   * @param $key
   * @return mixed
   */
  public function Encrypt($key);

  /**
   * Decrypts required key.
   * @param $key
   * @return mixed
   */
  public function Decrypt($key);

} 