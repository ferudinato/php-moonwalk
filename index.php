<?php
define('ROOT', dirname(__FILE__));
define('VIEWS_PATH', ROOT . '/application/views/');

require __DIR__ . '/vendor/autoload.php';

use Moonwalk\Core\Router;

// Init Router
$router = new Router();
$request_uri = $router->checkUri( $_SERVER['REQUEST_URI'] );
$router->checkController($request_uri[0], $request_uri[1], $request_uri[2]);
