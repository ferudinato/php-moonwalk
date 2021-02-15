<?php
use Moonwalk\Core\System;
use Dotenv\Dotenv;

// Load env variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define('APP_ENV', $_ENV['APP_ENV']);

define('VIEWS_PATH', ROOT . '/application/views/');
define('TMP_FOLDER', ROOT . '/tmp/logs/');

define('DEFAULT_CONTROLLER', 'welcome');
define('DEFAULT_METHOD', 'index');

$system = new System();

// set environment app
$system->set_environment();

// check if globals are enabled to disable it
$system->unregister_globals();

// configure app
$system->configure();

