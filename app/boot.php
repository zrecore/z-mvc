<?php

if (!defined('BOOT')) exit();

set_include_path(get_include_path() . PATH_SEPARATOR . (BASE_PATH . '/lib'));

if (!defined('APP_URL')) define('APP_URL', APP_ENV == 'production' ? 'http://localhost' : $_SERVER['HTTP_HOST']);

function __autoload( $class )
{
	$class = preg_replace('/\\\\/', DIRECTORY_SEPARATOR, $class);
	require $class . '.php';
}
spl_autoload_register('__autoload');

if (!App::getParam('api_key') && !defined('DISABLE_SESSION_AUTOSTART')) {
	session_start();
}