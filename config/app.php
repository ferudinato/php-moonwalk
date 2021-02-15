<?php
use Dotenv\Dotenv;

// Load env variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define('APP_ENV', $_ENV['APP_ENV']);

define('DEFAULT_CONTROLLER', 'welcome');
define('DEFAULT_METHOD', 'index');

