<?php
namespace system\library\security\encryption;

class Crypto implements CryptoInterface {

  /**
   * Encryption/Decryption key.
   * @var string
   */
  private $key;

  /**
   * Algorithm.
   * @var string
   */
  private $algorithm;

  public function __construct() {
    $this->key = SECRET_KEY;
    $this->algorithm = ENCRYPTION_TYPE;
  }

  /**
   * Encrypts required string.
   * @param $data
   * @return mixed|string
   */
  public function Encrypt($data) {
    $encrypted = mcrypt_encrypt($this->algorithm, $this->key, $data, MCRYPT_MODE_ECB);
    return base64_encode($encrypted);
  }

  /**
   * Decrypts required string.
   * @param $data
   * @return mixed|string
   */
  public function Decrypt($data) {
    $data = base64_decode($data);
    $decrypted = mcrypt_decrypt($this->algorithm, $this->key, $data, MCRYPT_MODE_ECB);
    return trim($decrypted);
  }

}