<?php
namespace application\forum\model;
use \system\core\Database;


class forumModel extends Database {

  function __construct() {
    parent::__construct();
    if (!$this->dbh) exit();
  }

  function index() {
    #$data = $this->dbh->query('SELECT * FROM users');
    #$data->setFetchMode(\PDO::FETCH_OBJ);

#    while ($row = $data->fetch()) {
 #     $row;
  #  }
  }

}