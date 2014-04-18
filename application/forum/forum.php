<?php
namespace application\forum;

use \system\app\Controller;
use \application\forum\model\forumModel;

/**
 * Class forum
 */
class forum extends Controller {

  private $db = null;

  function __construct() {
    $this->db = new forumModel();
  }

  /**
   * Index page.
   */
  function index() {
    $arr = array('key' => 'value');

    $this->db->index();
    echo $this->render('forum/index.twig', $arr);
  }

} 