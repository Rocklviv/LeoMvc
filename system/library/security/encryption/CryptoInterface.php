<?php
namespace system\library\security\encryption;

/**
 * Interface CryptoInterface
 * @package system\library
 */
interface CryptoInterface {

  public function __construct();

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