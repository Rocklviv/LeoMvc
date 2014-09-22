<?php
namespace application\forum\model;
#use \system\core\Database;
use \system\library\ActiveRecords\ActiveRecords;

class forumModel extends ActiveRecords {

  public $db = null;
  const TABLE = 'forum';

  function index() {
    $result = $this->table('test')
                   ->select();
    #var_dump($result);
  }
}