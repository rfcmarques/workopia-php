<?php
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'Framework/functions.php';

use Framework\Router;
use Framework\Session;

Session::start();

// Instantiate the router
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

// Get the current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri);
