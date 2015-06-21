<?php

namespace system\core;
use \system\exceptions\ErrorHandler;
use \system\exceptions\LeoException;
use \system\Application;

/**
 * Class Database
 * @package system\core
 * @author Denis Chekirda
 */
class Database extends Application {

  /**
   * Stores configuration.
   * @var array
   */
  private $cfg = array();

  /**
   * Reference to PDO instance.
   * @var null
   */
  public $dbh = null;

  /**
   * Gets configuration and initialize Database.
   */
  function __construct() {
    $this->cfg = $this->getConfigs();
    $this->initialize();
  }

  /**
   * Initialize Database.
   */
  function initialize() {
    self::prepConfiguration();
  }

  /**
   * Prepares database configuration.
   * @throws \system\exceptions\LeoException
   */
  private function prepConfiguration() {
    try {
      if (isset($this->cfg['database-type']) && !empty($this->cfg['database-type'])) {
        self::setConnection();
      } else {
        throw new LeoException('Error #2: Database Driver not set in system/configs/config.php');
      }
    } catch (LeoException $e) {
      $err = new ErrorHandler();
      $err->get500($e);
    }
  }

  /**
   * Sets DB connection via PDO.
   * @throws \PDOException
   */
  function setConnection() {
    $dbDriver = $this->cfg['database-type'];
    $dbPath = $this->cfg['sqlite-db-path'];
    try {
      if ($dbDriver != 'sqlite') {
        $this->dbh = new \PDO($dbDriver .
          ':host=' . $this->cfg['database-host'] .
          ';port=' . $this->cfg['database-port'] .
          ';dbname=' . $this->cfg['database-name'],
          $this->cfg['database-user'],
          $this->cfg['database-password']);
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      } else {
        $this->dbh = new \PDO($dbDriver . ':' . $dbPath);
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      }
    } catch (\PDOException $e) {
      $err = new ErrorHandler();
      $err->get500($e);
    }
  }
}
