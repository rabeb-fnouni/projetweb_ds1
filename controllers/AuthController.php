<?php
// controllers/AuthController.php

class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    // Register user
    public function register() {
        // Check if POST request
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            
            // Init data
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'full_name' => trim($_POST['full_name']),
                'student_id' => trim($_POST['student_id']),
                'role' => 'student',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'full_name_err' => '',
                'student_id_err' => ''
            ];
            
            // Validate username
            if(empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            } elseif(strlen($data['username']) < 4) {
                $data['username_err'] = 'Username must be at least 4 characters';
            } elseif($this->userModel->findUserByUsername($data['username'])) {
                $data['username_err'] = 'Username is already taken';
            }
            
            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter a valid email';
            } elseif($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'Email is already taken';
            }
            
            // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            
            // Validate confirm password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }
            
            // Validate full name
            if(empty($data['full_name'])) {
                $data['full_name_err'] = 'Please enter your full name';
            }
            
            // Validate student ID
            if(empty($data['student_id'])) {
                $data['student_id_err'] = 'Please enter student ID';
            } elseif($this->userModel->findUserByStudentId($data['student_id'])) {
                $data['student_id_err'] = 'Student ID is already registered';
            }
            
            // Make sure errors are empty
            if(empty($data['username_err']) && empty($data['email_err']) && 
               empty($data['password_err']) && empty($data['confirm_password_err']) && 
               empty($data['full_name_err']) && empty($data['student_id_err'])) {
                
                // Register user
                $userId = $this->userModel->register($data);
                
                if($userId) {
                    // Set flash message
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'You are now registered and can log in'
                    ];
                    
                    // Redirect to login
                    header('Location: ' . BASE_URL . 'views\auth\login.php');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                require_once 'views\auth\register.php';
            }
        } else {
            // Init data
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'full_name' => '',
                'student_id' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'full_name_err' => '',
                'student_id_err' => ''
            ];
            
            // Load view
            require_once 'views\auth\register.php';
        }
    }
    
    // Login user
    public function login() {
        // Check if POST request
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            
            // Init data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];
            
            // Validate username
            if(empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            }
            
            // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            
            // Check if all errors are empty
            if(empty($data['username_err']) && empty($data['password_err'])) {
                // Attempt login
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                
                if($loggedInUser) {
                    // Create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect or user does not exist';
                    require_once 'views\auth\login.php';
                }
            } else {
                // Load view with errors
                require_once 'views\auth\login.php';
            }
        } else {
            // Init data
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            
            // Load view
            require_once 'views\auth\login.php';
        }
    }
    
    // Create user session
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->username;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_full_name'] = $user->full_name;
        $_SESSION['user_role'] = $user->role;
        
        if($user->role == 'admin') {
            header('Location: ' . BASE_URL . 'views\admin\dashboard.php');
        } else {
            header('Location: ' . BASE_URL . 'views\admin\clubs.php');
        }
    }
    
    // Logout user
    public function logout() {
        // Unset session variables
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_full_name']);
        unset($_SESSION['user_role']);
        
        // Destroy session
        session_destroy();
        
        // Redirect to login
        header('Location: ' . BASE_URL . 'views\auth\login.php');
    }
    
    // Check if user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    // Check if user is admin
    public function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
    }
}
?>
                