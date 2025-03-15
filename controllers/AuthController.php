<?php
// File: controllers/AuthController.php
class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate input
            $errors = [];
            
            if (empty($_POST['name'])) {
                $errors[] = "Name is required";
            }
            
            if (empty($_POST['email'])) {
                $errors[] = "Email is required";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            } else {
                // Check if email exists
                $existingUser = new User();
                if ($existingUser->getByEmail($_POST['email'])) {
                    $errors[] = "Email already exists";
                }
            }
            
            if (empty($_POST['password'])) {
                $errors[] = "Password is required";
            } elseif (strlen($_POST['password']) < 6) {
                $errors[] = "Password must be at least 6 characters";
            }
            
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $errors[] = "Passwords do not match";
            }
            
            if (empty($errors)) {
                // Create user
                $this->userModel->name = $_POST['name'];
                $this->userModel->email = $_POST['email'];
                $this->userModel->password = $_POST['password'];
                $this->userModel->role = 'student'; // Default role
                
                $id = $this->userModel->create();
                
                if ($id) {
                    // Set session
                    $_SESSION['user_id'] = $id;
                    $_SESSION['user_name'] = $this->userModel->name;
                    $_SESSION['role'] = $this->userModel->role;
                    
                    header('Location: index.php');
                    exit;
                } else {
                    $errors[] = "Something went wrong";
                }
            }
            
            // If there are errors, include register view with errors
            include 'views/auth/register.php';
        } else {
            // Show registration form
            include 'views/auth/register.php';
        }
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate input
            $errors = [];
            
            if (empty($_POST['email'])) {
                $errors[] = "Email is required";
            }
            
            if (empty($_POST['password'])) {
                $errors[] = "Password is required";
            }
            
            if (empty($errors)) {
                // Check if user exists
                if ($this->userModel->getByEmail($_POST['email'])) {
                    // Verify password
                    if (password_verify($_POST['password'], $this->userModel->password)) {
                        // Set session
                        $_SESSION['user_id'] = $this->userModel->id;
                        $_SESSION['user_name'] = $this->userModel->name;
                        $_SESSION['role'] = $this->userModel->role;
                        
                        // Redirect based on role
                        if ($this->userModel->role === 'admin') {
                            header('Location: index.php?page=admin');
                        } else {
                            header('Location: index.php');
                        }
                        exit;
                    } else {
                        $errors[] = "Invalid password";
                    }
                } else {
                    $errors[] = "User not found";
                }
            }
            
            // If there are errors, include login view with errors
            include 'views/auth/login.php';
        } else {
            // Show login form
            include 'views/auth/login.php';
        }
    }
    
    public function logout() {
        // Unset all session variables
        $_SESSION = array();
        
        // Destroy the session
        session_destroy();
        
        // Redirect to home
        header('Location: index.php');
        exit;
    }
}