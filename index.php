<?php
// If is set TRUE, debug is on otherwise off.
define('LeoDebug', true);

if (defined('LeoDebug') && LeoDebug != false) {
  // Report all PHP errors
  error_reporting(-1);

  // Same as error_reporting(E_ALL);
  ini_set('error_reporting', E_ALL);

  // Display errors
  ini_set('display_errors', 'on');
}

// Directory where stored application controllers.
define('APP', 'application');
//
define('APP_STATE', 'development');
// Template dir.
define('TEMPLATE_DIR', 'templates');
// Cache dir.
define('CACHE', 'cache');

// Encryption type
define('ENCRYPTION_TYPE', MCRYPT_RIJNDAEL_256);

// Secret key that used for Encryption/decryption. The length of key 32 characters.
define('SECRET_KEY', '3yhj3b6psja370x56g2i9o359pFg4q1b');

// Including a bootstrap application class.
require('system/application.php');

$app = new \system\Application();
$app::start();