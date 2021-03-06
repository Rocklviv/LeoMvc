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
    $this->db->index();

    if ($_SERVER['REQUEST_METHOD'] && $_REQUEST['test_text']) {
      $this->db->setData($_REQUEST['test_text']);
    }
    echo $this->render('forum/index.twig');
  }

} 
