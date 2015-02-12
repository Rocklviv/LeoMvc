<?php

namespace system\library\ActiveRecords\Adapters;

/**
 * Interface PDO_Adapter_Interfaces
 * @package system\library\ActiveRecords\Adapters
 */
interface PDO_Adapter_Interfaces {

  /**
   * @return mixed
   */
  public function connect();

  /**
   * @return mixed
   */
  public function disconnect();

  /**
   * @param $sql
   * @param array $options
   * @return mixed
   */
  public function prepare($sql, array $options = array());

  /**
   * @param array $paramaters
   * @return mixed
   */
  public function execute(array $paramaters = array());

  /**
   * @param null $fetchStyle
   * @param null $cursorOrientation
   * @param null $cursorOffset
   * @return mixed
   */
  public function fetch($fetchStyle = null, $cursorOrientation = null,
    $cursorOffset = null);

  /**
   * @param null $fetchStyle
   * @param int $column
   * @return mixed
   */
  public function fetchAll($fetchStyle = null, $column = 0);

  /**
   * @param $table
   * @param array $bind
   * @param string $boolOperation
   * @return mixed
   */
  public function select($table, array $bind, $boolOperation = "AND");

  /**
   * @param $table
   * @param array $bind
   * @return mixed
   */
  public function insert($table, array $bind);

  /**
   * @param $table
   * @param array $bind
   * @param string $where
   * @return mixed
   */
  public function update($table, array $bind, $where = "");

  /**
   * @param $table
   * @param string $where
   * @return mixed
   */
  public function delete($table, $where = "");

}
