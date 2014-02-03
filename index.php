<?php
// If is set TRUE, debug is on otherwise off.
define('LeoDebug', true);

if (defined('LeoDebug')) {
	// Report all PHP errors
	error_reporting(-1);

	// Same as error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);
}

// Directory where stored application controllers.
define('APP', 'application');

// Including a bootstrap application class.
require('system/application.php');

$app = new \system\Application();
$app::start();