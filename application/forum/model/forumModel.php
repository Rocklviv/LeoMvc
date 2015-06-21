<?php
namespace application\forum\model;
use \system\library\ActiveRecords\ActiveRecords;

class forumModel extends ActiveRecords {

  public $db = null;
  protected $config = array();

  function __construct() {
    $this->config = \system\Application::getConfigs();
    $dns = $this->config['database-type'] .
      ':host=' . $this->config['database-host'] .
      ';port=' . $this->config['database-port'] .
      ';dbname=' . $this->config['database-name'];

    parent::__construct($dns, $this->config['database-user'], $this->config['database-password']);
  }

  function index() {
    $result = $this->select('test');
    var_dump($result->fetchAll());
  }

  function setData($data) {
    $result = $this->insert('test', $data);
  }
}
