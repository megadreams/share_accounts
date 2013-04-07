<?php

// Load in the Autoloader
require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';


Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
));

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGE
 * Fuel::PRODUCTION
 */


// 動作環境切り替え
define('ENVIRONMENT_DEVELOPMENT', 'development');
define('ENVIRONMENT_TESTING'    , 'testing');
define('ENVIRONMENT_PRODUCTION' , 'production');


//本番環境
if ( file_exists(DOCROOT.'/../.production') || file_exists(DOCROOT.'/.production')) {
	Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::PRODUCTION);
	define('ENVIRONMENT', ENVIRONMENT_PRODUCTION);

//テスト環境
} else if (file_exists(DOCROOT.'/../.test') || file_exists(DOCROOT.'/.test')) {
	Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::TEST);
	define('ENVIRONMENT', ENVIRONMENT_TESTING);	
	define('BASE_URL', 'http://megadreams14.com/app/share_accounts/public/');	
//ローカル環境
} else {
	Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);
	define('ENVIRONMENT', ENVIRONMENT_DEVELOPMENT);	
	define('BASE_URL', 'http://localhost/share_accounts/public/');	
}
// Initialize the framework with the config file.
Fuel::init('config.php');
