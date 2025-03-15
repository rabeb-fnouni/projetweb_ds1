<?php
// controllers/ApplicationController.php

class ApplicationController {
    private $applicationModel;
    private $clubModel;
    private $userModel;
    private $authController;

    public function __construct() {
        $this->applicationModel = new Application();
        $this->clubModel = new Club();
        $this->userModel = new User();
        $this->authController = new AuthController();

        // Check if user is logged in
        if (!$this->authController->isLoggedIn()) {
            header('Location: ' . BASE_URL . 'views\auth\login.php');
            exit();
        }
    }

    // Display all applications for the logged-in user
    public function index() {
        $userId = $_SESSION['user_id'];
        $applications = $this->applicationModel->getApplicationsByUser Id($userId);
        require_once 'views\applications\index.php';
    }

    // Show the application form for a specific club
    public function apply($clubId) {
        $club = $this->clubModel->findClubById($clubId);
        if (!$club) {
            require_once 'views\errors\404.php';
            return;
        }
        require_once 'views\clubs\apply.php';
    }

    // Handle the application submission
    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'club_id' => trim($_POST['club_id']),
                'cv_file' => $_FILES['cv_file']['name'],
                'motivation' => trim($_POST['motivation']),
                'status' => 'pending',
                'cv_err' => '',
                'motivation_err' => ''
            ];

            // Validate CV file upload
            if (empty($data['cv_file'])) {
                $data['cv_err'] = 'Please upload your CV.';
            } else {
                // Check file type and size (you can customize this)
                $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                if (!in_array($_FILES['cv_file']['type'], $allowedTypes)) {
                    $data['cv_err'] = 'Invalid file type. Only PDF and Word documents are allowed.';
                }
                if ($_FILES['cv_file']['size'] > 2000000) { // 2MB limit
                    $data['cv_err'] = 'File size must be less than 2MB.';
                }
            }

            // Make sure errors are empty
            if (empty($data['cv_err']) && empty($data['motivation_err'])) {
                // Move the uploaded CV file to the uploads directory
                $targetDir = '../public/uploads/cv/';
                $targetFile = $targetDir . basename($data['cv_file']);
                move_uploaded_file($_FILES['cv_file']['tmp_name'], $targetFile);

                // Insert application into the database
                if ($this->applicationModel->createApplication($data)) {
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Application submitted successfully!'
                    ];
                    header('Location: ' . BASE_URL . '/applications');
                } else {
                    die('Something went wrong while submitting your application.');
                }
            } else {
                // Load the application form with errors
                $club = $this->clubModel->findClubById($data['club_id']);
                require_once 'views\clubs\apply.php';
            }
        } else {
            // Redirect to the home page if not a POST request
            header('Location: ' . BASE_URL . '/home');
        }
    }

    // Admin view all applications
    public function adminIndex() {
        $applications = $this->applicationModel->getAllApplications();
        require_once 'views\admin\applications.php';
    }

    // Approve an application
    public function approve($applicationId) {
        if ($this->applicationModel->updateApplicationStatus($applicationId, 'approved')) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Application approved successfully!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Failed to approve the application.'
            ];
        }
        header('Location: ' . BASE_URL . '/applications');
    }

    // Reject an application
    public function reject($applicationId) {
        if ($this->applicationModel->updateApplicationStatus($applicationId, 'rejected')) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Application rejected successfully!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Failed to reject the application.'
            ];
        }
        header('Location: ' . BASE_URL . '/applications');
    }
}
?>