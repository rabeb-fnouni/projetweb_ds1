<?php
// File: index.php - Main entry point
session_start();
require_once 'config/database.php';
require_once 'utils/functions.php';

// Load models
require_once 'models/User.php';
require_once 'models/Club.php';
require_once 'models/Application.php';
require_once 'models/Stat.php';

// Load controllers
require_once 'controllers/AuthController.php';
require_once 'controllers/ClubController.php';
require_once 'controllers/ApplicationController.php';
require_once 'controllers/AdminController.php';

// Simple routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($page) {
    case 'home':
        include 'views/home.php';
        break;
    
    case 'clubs':
        $controller = new ClubController();
        if ($action === 'detail' && isset($_GET['id'])) {
            $controller->show($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    
    case 'auth':
        $controller = new AuthController();
        if ($action === 'login') {
            $controller->login();
        } elseif ($action === 'register') {
            $controller->register();
        } elseif ($action === 'logout') {
            $controller->logout();
        } else {
            include 'views/auth/login.php';
        }
        break;
    
    case 'apply':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=auth&action=login');
            exit;
        }
        $controller = new ApplicationController();
        if ($action === 'submit') {
            $controller->submit();
        } else {
            $controller->showForm($_GET['club_id'] ?? null);
        }
        break;
    
    case 'admin':
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?page=auth&action=login');
            exit;
        }
        $controller = new AdminController();
        if ($action === 'stats') {
            $controller->showStats();
        } else {
            $controller->dashboard();
        }
        break;
    
    default:
        include 'views/home.php';
        break;
}