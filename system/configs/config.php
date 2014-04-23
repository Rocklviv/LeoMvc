<?php

  $config = array(
    'appName' => 'LeoEngine FrameWork v.1.1',
    // Database section
    'database-type' => 'mysql',
    'database-host' => '127.0.0.1', //Try not to use a FQDN name for database host use IP address due to slow performance of PDO driver.
    'database-port' => '8889',
    'database-name' => 'test',
    'database-user' => 'root',
    'database-password' => 'root',
    'sqlite-db-path' => '' // If database type is not set as sqlite leave value empty.
  );