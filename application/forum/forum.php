<?php
namespace application\forum;

use \system\app\Controller;
use \application\forum\model\forumModel;
use \system\library\security\encryption\Crypto;

/**
 * Class forum
 */
class forum extends Controller {

  private $db = null;

  private $crypto = null;

  function __construct() {
    $this->db = new forumModel();
    $this->crypto = new Crypto();
  }

  /**
   * Index page.
   */
  function index() {
    $arr = array('key' => 'value');

    $this->db->index();

    $enc = $this->crypto->Encrypt('Ac3ral2416w');
    $dec = $this->crypto->Decrypt($enc);

    echo "Encrypted: " . $enc . '<br/>';
    echo "Decrypted: " . $dec . '<br/>';

    echo $this->render('forum/index.twig', $arr);
  }

} 