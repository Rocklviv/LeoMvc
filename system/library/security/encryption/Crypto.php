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

  /**
   * @param $key
   * @param string $algorithm
   */
  public function __construct($key, $algorithm = MCRYPT_BLOWFISH) {
    $this->key = substr($key, 0, mcrypt_get_key_size($algorithm, MCRYPT_MODE_ECB));
    $this->algorithm = $algorithm;
  }

  /**
   * Encrypts required string.
   * @param $data
   * @return mixed|string
   */
  public function Encrypt($data) {
    $getSize = mcrypt_get_iv_size($this->algorithm, MCRYPT_MODE_ECB);
    $sizeIv = mcrypt_create_iv($getSize, MCRYPT_RAND);

    $encrypted = mcrypt_encrypt($this->algorithm, $this->key, $data, MCRYPT_MODE_ECB, $sizeIv);
    return trim(base64_encode($encrypted));
  }

  /**
   * Decrypts required string.
   * @param $data
   * @return mixed|string
   */
  public function Decrypt($data) {
    $encrypted = base64_encode($data);
    $getSize = mcrypt_get_iv_size($this->algorithm, MCRYPT_MODE_ECB);
    $sizeIv = mcrypt_create_iv($getSize, MCRYPT_RAND);

    $decrypt = mcrypt_decrypt($this->algorithm, $this->key, $encrypted, MCRYPT_MODE_ECB, $sizeIv);

    return trim($decrypt);
  }

}