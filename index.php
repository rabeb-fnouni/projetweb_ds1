<?php
// index.php

// Load configuration
require_once 'config\config.php';

// Load the autoloader
require_once 'autoload.php';

// Start the session
session_start();

// Get the URL from the query string
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'views\home\index.php';

// Split the URL into parts
$urlParts = explode('/', $url);

// Get the controller name and method
$controllerName = ucfirst($urlParts[0]) . 'Controller';
$methodName = isset($urlParts[1]) ? $urlParts[1] : 'index';

// Check if the controller exists
if (class_exists($controllerName)) {
    $controller = new $controllerName();

    // Check if the method exists
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], array_slice($urlParts, 2));
    } else {
        // Method not found, show 404 error
        require_once 'views\errors\404.php';
    }
} else {
    // Controller not found, show 404 error
    require_once 'views\errors\404.php';
}
?>