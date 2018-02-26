<?php

use DroplineMVC\Core\Router;

/////////// Benchmarking autoloading
// Composer’s autoloader
require_once '../vendor/autoload.php';

// My Custom Autoloader
//require_once('../utils/CustomAutoloader.php');
///////////

# Environment variables
$dotenv = new Dotenv\Dotenv('../');
$dotenv->load();
echo "HELLO333444435sss3455554d4!";
// Create session
session_start();

// Include config
require_once('../config/Config.php');
// Gettext - set user language
//require_once('../config/Config_i18n.php');

// Error and exception handling
error_reporting(E_ALL); // Display all types of errors. Or change php.ini to effect all scripts.
set_error_handler(NS_MAIN . "\\" . NS_UTILS . "\ErrorHandler::errorHandler");
set_exception_handler(NS_MAIN . "\\" . NS_UTILS . "\ErrorHandler::exceptionHandler");

// #CONFIG_1 - Change accordingly .htaccess file configuration
/*
// Data Filtering - sanitize input request - remove all illegal characters from url string
$url = filter_var($_GET['url'] ?? '', FILTER_SANITIZE_URL);

$route = explode('/', $url);

// Routing
$router = new Router(array('controller'=>$route[0] ?? '', 'action'=>$route[1] ?? '', 'id'=>$route[2] ?? ''));
$controller = $router->createController();
if ($controller) {
    $controller->execute();
}
*/

// #CONFIG_2 - Change accordingly .htaccess file configuration
// Routing
$router = new Router($_GET);
$controller = $router->createController();
if ($controller) {
    $controller->execute();
}