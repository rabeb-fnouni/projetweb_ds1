<?php
// controllers/AdminController.php

class AdminController {
    private $clubModel;
    private $memberModel;
    private $applicationModel;
    private $statsModel;
    private $authController;

    public function __construct() {
        $this->clubModel = new Club();
        $this->memberModel = new Member();
        $this->applicationModel = new Application();
        $this->statsModel = new Stats();
        $this->authController = new AuthController();

        // Check if user is logged in and is admin
        if (!$this->authController->isLoggedIn() || !$this->authController->isAdmin()) {
            header('Location: ' . BASE_URL . 'views\auth\login.php');
            exit();
        }
    }

    // Admin dashboard
    public function dashboard() {
        // Load view
        require_once 'views\admin\dashboard.php';
    }

    // Manage clubs
    public function clubs() {
        $clubs = $this->clubModel->getClubs();
        require_once 'views\admin\clubs.php';
    }

    // Manage applications
    public function applications() {
        $applications = $this->applicationModel->getApplications();
        require_once 'views\admin\applications.php';
    }

    // Manage members
    public function members() {
        $members = $this->memberModel->getMembers();
        require_once 'views\admin\members.php';
    }

    // View statistics
    public function stats() {
        $clubStats = $this->statsModel->getClubMembershipStats();
        $applicationStats = $this->statsModel->getClubApplicationStats();
        require_once 'views\admin\stats.php';
    }
}
?>