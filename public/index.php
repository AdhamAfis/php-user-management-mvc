<?php
// Define the application root directory
define('APP_ROOT', dirname(__DIR__));

$request = $_SERVER['REQUEST_URI'];

// Remove query string and trailing slash
$request = strtok($request, '?');
$request = rtrim($request, '/');

// If no specific page is requested, redirect to login
if ($request === '' || $request === '/') {
    $request = '/login';
}

// Map routes to files
$routes = [
    '/login' => '/app/views/login.php',
    '/register' => '/app/views/register.php',
    '/dashboard' => '/app/views/dashboard.php',
    '/logout' => '/app/views/logout.php'
];

// Check if route exists
if (array_key_exists($request, $routes)) {
    require APP_ROOT . $routes[$request];
} else {
    http_response_code(404);
    echo "404 Not Found";
}
