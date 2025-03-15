<?php
// config/config.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // Default WAMP username
define('DB_PASS', '');      // Default WAMP password is empty
define('DB_NAME', 'essect_clubs_db');

define('BASE_URL', 'http://localhost/essect_clubs');
define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/essect_clubs/public/uploads/');
define('CV_UPLOAD_DIR', UPLOAD_DIR . 'cv/');

// Application constants
define('APP_NAME', 'ESSECT Clubs');
define('APP_VERSION', '1.0.0');

// Define roles
define('ROLE_ADMIN', 'admin');
define('ROLE_STUDENT', 'student');

// Session lifetime
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
