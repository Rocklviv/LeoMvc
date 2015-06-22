<?php
/**
 * System configuration.
 * @type array
 */
$config = array(
  'appName' => 'Leo FrameWork v.1.1',
  'auth-type' => 'basic',
  // Database section
  'database-type' => 'mysql',
  'database-host' => 'localhost', //Try not to use a FQDN name for database host use IP address due to slow performance of PDO driver.
  'database-port' => '8889',
  'database-name' => 'leomvc',
  'database-user' => 'leomvc',
  'database-password' => 'leomvc',
  'sqlite-db-path' => '' // If database type is not set as sqlite leave value empty.
);
