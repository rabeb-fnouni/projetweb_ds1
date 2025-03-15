<?php
// controllers/ProfileController.php

class ProfileController {
    private $userModel;
    private $authController;

    public function __construct() {
        $this->userModel = new User();
        $this->authController = new AuthController();

        // Check if user is logged in
        if (!$this->authController->isLoggedIn()) {
            header('Location: ' . BASE_URL . 'views\auth\login.php');
            exit();
        }
    }

    // View profile
    public function index() {
        $user = $this->userModel->findUser ById($_SESSION['user_id']);
        require_once 'views\profile\index.php';
    }

    // Update profile
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data = [
                'id' => $_SESSION['user_id'],
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'full_name' => trim($_POST['full_name']),
                'username_err' => '',
                'email_err' => '',
                'full_name_err' => ''
            ];

            // Validate input
            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            }
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            if (empty($data['full_name'])) {
                $data['full_name_err'] = 'Please enter your full name';
            }

            // Make sure errors are empty
            if (empty($data['username_err']) && empty($data['email_err']) && empty($data['full_name_err'])) {
                if ($this->userModel->updateUser ($data)) {
                    // Set flash message
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Profile updated successfully'
                    ];
                    header('Location: ' . BASE_URL . 'views\profile');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                require_once 'views\profile\index.php';
            }
        } else {
            // Load view
            $this->index();
        }
    }
}
?>