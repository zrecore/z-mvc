<?php

define('BASE_PATH', dirname(realpath(__DIR__)));
define('APP_PATH', BASE_PATH . '/app');
define('APP_ENV', 'development');

// ...Use the MVC
	define('BOOT', true);
	define('DISABLE_SESSION_AUTOSTART', false);
	
	require_once(APP_PATH . '/boot.php');


	App::callMVC();