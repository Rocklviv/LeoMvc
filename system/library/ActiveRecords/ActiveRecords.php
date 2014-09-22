<?php
namespace system\library\ActiveRecords;
use \system\core\Database;

class ActiveRecords extends Database {

  private $tableName = '';

  protected $q_string = array();

  protected $q_where = array();

  protected $q_join = array();

  function __construct() {
    parent::__construct();
    if (!$this->dbh) exit();
  }

  /**
   * Sets table name.
   * @param $table string Table name.
   * @return $this
   */
  function table($table) {
    if ($table == '' || $table == null) {
      print 'Set the table name';
    } else {
      $this->tableName = $table;
    }
    return $this;
  }

  /**
   * @return array
   */
  function selectAll() {
    $query = $this->dbh->query('SELECT * FROM '. $this->tableName);
    $query->setFetchMode(\PDO::FETCH_OBJ);

    return self::fetchAll($query);
  }

  function select($string = '*') {
    $query = 'SELECT ' . $string . ' FROM ' . $this->tableName;
    var_dump($this);
    return $this;
  }



  /**
   * @param $query PDO object.
   * @return array
   */
  function fetchAll($query) {
    $result = [];
    while ($row = $query->fetch()) {
      $result[] = $row;
    }

    return $result;
  }

} 