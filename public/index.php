<?php
	ini_set('display_errors', true);
	error_reporting(E_ALL ^ E_NOTICE);
	
	define('REQUEST_MICROTIME', microtime(true));
		
	
	/**
	 * This makes our life easier when dealing with paths. Everything is relative
	 * to the application root now.
	 */
	chdir(dirname(__DIR__));
	
	define("APPLICATION_PATH", realpath(getcwd()));
	
	// Setup autoloading
	include 'init_autoloader.php';
	
	define('BASE_URL', 'http://sites.local/app/public/');
	//var_dump(class_exists('Zend\Mvc\Application'));exit;
	// Run the application!
	Zend\Mvc\Application::init(include 'config/application.config.php')->run();
