<?php
// autoload.php

spl_autoload_register(function ($className) {
    // Define the base directory for the project
    $baseDir = __DIR__ . 'public\uploads\cv\essect_clubs.sql';

    // Define the paths for the models and controllers
    $modelPath = $baseDir . 'models/' . $className . '.php';
    $controllerPath = $baseDir . 'controllers/' . $className . '.php';

    // Check if the model file exists and include it
    if (file_exists($modelPath)) {
        require_once $modelPath;
    }

    // Check if the controller file exists and include it
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
    }
});
?>