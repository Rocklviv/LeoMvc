<?php

namespace system\library\ActiveRecords;
use \system\library\ActiveRecords\Adapters\PDO_Adapter_Interfaces;
use \system\exceptions\DatabaseException;

/**
 * Class ActiveRecords
 * @package system\library\ActiveRecords
 */
class ActiveRecords implements PDO_Adapter_Interfaces {

  /**
   * Stores configuration.
   * @var array
   */
  protected $config = array();

  /**
   * Stores active DB connection.
   * @var null
   */
  protected $connection = null;

  /**
   * Represents a prepared statement and,
   * after the statement is executed,
   * an associated result set.
   * @var null
   */
  protected $statement = null;

  /**
   * Returns an array indexed by column
   * name as returned in your result set
   * @var int
   */
  protected $fetchMode = \PDO::FETCH_ASSOC;

  /**
   * @param $dsn MySQL DSN Connect string.
   * @param null $username Username DB.
   * @param null $password Password DB.
   * @param array $driverOptions
   */
  function __construct($dsn, $username = null,
    $password = null, array $driverOptions = array())
  {
    $this->config = compact("dsn", "username", "password", "driverOptions");
  }

  /**
   * Gets PDO statement.
   * @return null
   */
  public function getStatement() {
    if ($this->statement === null) {
      throw new DatabaseException('
        There is no PDOStatement object for use.
      ');
    }
    return $this->statement;
  }

  /**
   * @return mixed|void
   */
  public function connect() {
    if ($this->connection) {
      return;
    }

    try {
      $this->connection = new \PDO(
      $this->config['dsn'],
      $this->config['username'],
      $this->config['password'],
      $this->config['driverOptions']
      );

      $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    } catch (\PDOException $e) {
      throw new DatabaseException($e->getMessage());
    }
  }

  /**
   * Disconnect from DB.
   */
  public function disconnect() {
    $this->connection = null;
  }

  /**
   * Prepare SQL Query to execute.
   * @param $sql
   * @param array $options
   * @return mixed|void
   */
  public function prepare($sql, array $options = array()) {
    $this->connect();

    try {
      $this->statement = $this->connection->prepare($sql, $options);
      return $this;
    } catch (\PDOException $e) {
      throw new DatabaseException($e->getMessage());
    }
  }

  /**
   * Executes prepared SQL query.
   * @param array $paramaters (array(':calories' => $calories, ':colour' => $colour)).
   * @return mixed|void
   */
  public function execute(array $paramaters = array()) {
    try {
      $this->getStatement()->execute($paramaters);
      return $this;
    } catch (\PDOException $e) {
      throw new DatabaseException($e->getMessage());
    }
  }

  /**
   * @param null $fetchStyle
   * @param null $cursorOrientation
   * @param null $cursorOffset
   * @return mixed|void
   */
  public function fetch($fetchStyle = null, $cursorOrientation = null,
    $cursorOffset = null) {

      if ($fetchStyle === null) {
        $fetchStyle = $this->fetchMode;
      }

      try {
        return $this->getStatement()->fetch($fetchStyle,
          $cursorOrientation, $cursorOffset);
      }
      catch (\PDOException $e) {
        throw new DatabaseException($e->getMessage());
      }
  }

  /**
   * @param null $fetchStyle
   * @param int $column
   * @return mixed|void
   */
  public function fetchAll($fetchStyle = null, $column = 0) {
    if ($fetchStyle === null) {
      $fetchStyle = $this->fetchMode;
    }

    try {
      return $fetchStyle === \PDO::FETCH_COLUMN
      ? $this->getStatement()->fetchAll($fetchStyle, $column)
      : $this->getStatement()->fetchAll($fetchStyle);
    }
    catch (\PDOException $e) {
      throw new DatabaseException($e->getMessage());
    }
  }

  /**
   * @param string $table
   * @param array $bind
   * @param string $boolOperation
   * @return $this
   */
  public function select($table, array $bind = array(), $boolOperation = "AND") {
    if ($bind) {
      $where = array();
      foreach ($bind as $col => $value) {
        unset($bind[$col]);
        $bind[":" . $col] = $value;
        $where[] = $col . " = :" . $col;
      }
    }

    $sql = "SELECT * FROM " . $table
      . (($bind) ? " WHERE "
      . implode(" " . $boolOperation . " ", $where) : " ");
      $this->prepare($sql)->execute($bind);

    return $this;
  }

  /**
   * @param $table
   * @param array $bind
   * @return int
   */
  public function insert($table, array $bind) {
    $cols = implode(", ", array_keys($bind));
    $values = implode(", :", array_keys($bind));
    foreach ($bind as $col => $value) {
      unset($bind[$col]);
      $bind[":" . $col] = $value;
    }

    $sql = "INSERT INTO " . $table
      . " (" . $cols . ")  VALUES (:" . $values . ")";
    return (int) $this->prepare($sql)
      ->execute($bind)
      ->getLastInsertId();
  }

  /**
   * @param $table
   * @param array $bind
   * @param string $where
   * @return mixed
   */
  public function update($table, array $bind, $where = "") {
    $set = array();
    foreach ($bind as $col => $value) {
      unset($bind[$col]);
      $bind[":" . $col] = $value;
      $set[] = $col . " = :" . $col;
    }

    $sql = "UPDATE " . $table . " SET " . implode(", ", $set)
      . (($where) ? " WHERE " . $where : " ");
    return $this->prepare($sql)
      ->execute($bind)
      ->countAffectedRows();
  }

  /**
   * @param $table
   * @param string $where
   * @return mixed
   */
  public function delete($table, $where = "") {
    $sql = "DELETE FROM " . $table . (($where) ? " WHERE " . $where : " ");
    return $this->prepare($sql)
      ->execute()
      ->countAffectedRows();
  }
}
