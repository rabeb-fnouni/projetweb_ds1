<?php
// controllers/ClubController.php

class ClubController {
    private $clubModel;
    private $memberModel;
    private $eventModel;
    private $authController;
    
    public function __construct() {
        $this->clubModel = new Club();
        $this->memberModel = new Member();
        $this->eventModel = new Event();
        $this->authController = new AuthController();
    }
    
    // Index page - show all clubs
    public function index() {
        // Get all clubs
        $clubs = $this->clubModel->getClubs();
        
        // Load view
        require_once 'views\clubs\index.php';
    }
    
    // Show single club
    public function show($id) {
        // Check if club exists
        if(!$this->clubModel->clubExists($id)) {
            // Set flash message
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Club not found'
            ];
            
            // Redirect to clubs page
            header('Location: ' . BASE_URL . 'clubs');
            exit();
        }
        
        // Get club details
        $club = $this->clubModel->getClubById($id);
        
        // Get upcoming events
        $events = $this->eventModel->getEventsByClub($id);
        
        // Check if user is member (if logged in)
        $isMember = false;
        if($this->authController->isLoggedIn()) {
            $isMember = $this->memberModel->isMember($_SESSION['user_id'], $id);
        }
        
        // Load view
        require_once 'views\clubs\detail.php';
    }
    
    // Apply for club membership
    public function apply($id) {
        // Check if user is logged in
        if(!$this->authController->isLoggedIn()) {
            // Set flash message
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'You must be logged in to apply'
            ];
            
            // Redirect to login page
            header('Location: ' . BASE_URL . 'views\auth\login.php');
            exit();
        }
        
        // Check if club exists
        if(!$this->clubModel->clubExists($id)) {
            // Set flash message
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Club not found'
            ];
            
            // Redirect to clubs page
            header('Location: ' . BASE_URL . '/clubs');
            exit();
        }
        
        // Get club details
        $club = $this->clubModel->getClubById($id);
        
        // Check if already a member
        $isMember = $this->memberModel->isMember($_SESSION['user_id'], $id);
        if($isMember) {
            // Set flash message
            $_SESSION['flash_message'] = [
                'type' => 'info',
                'message' => 'You are already a member of this club'
            ];
            
            // Redirect to club page
            header('Location: ' . BASE_URL . 'views\clubs\show.php' . $id);
            exit();
        }
        
        // Check if already applied
        $applicationModel = new Application();
        if($applicationModel->hasApplied($_SESSION['user_id'], $id)) {
            // Set flash message
            $_SESSION['flash_message'] = [
                'type' => 'info',
                'message' => 'You have already applied to this club'
            ];
            
            // Redirect to club page
            header('Location: ' . BASE_URL . 'views\clubs\show.php' . $id);
            exit();
        }
        
        // Process form if submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            
            // Init data
            $data = [
                'user_id' => $_SESSION['user_id'],
                'club_id' => $id,
                'motivation' => trim($_POST['motivation']),
                'cv_file' => '',
                'motivation_err' => '',
                'cv_err' => ''
            ];
            
            // Validate motivation
            if(empty($data['motivation'])) {
                $data['motivation_err'] = 'Please enter your motivation';
            }
            
            // Validate CV file
            if(empty($_FILES['cv_file']['name'])) {
                $data['cv_err'] = 'Please upload your CV';
            } else {
                // Get file info
                $fileName = $_FILES['cv_file']['name'];
                $fileTmpName = $_FILES['cv_file']['tmp_name'];
                $fileSize = $_FILES['cv_file']['size'];
                $fileError = $_FILES['cv_file']['error'];
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                
                // Allowed extensions
                $allowed = array('pdf', 'doc', 'docx');
                
                // Check extension
                if(!in_array($fileExt, $allowed)) {
                    $data['cv_err'] = 'CV must be PDF, DOC or DOCX file';
                }
                
                // Check for errors
                if($fileError !== 0) {
                    $data['cv_err'] = 'Error uploading file';
                }
                
                // Check size (5MB max)
                if($fileSize > 5000000) {
                    $data['cv_err'] = 'File too large (max 5MB)';
                }
                
                // Create unique filename
                if(empty($data['cv_err'])) {
                    $fileNameNew = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = CV_UPLOAD_DIR . $fileNameNew;
                    
                    // Create directory if it doesn't exist
                    if(!file_exists(CV_UPLOAD_DIR)) {
                        mkdir(CV_UPLOAD_DIR, 0777, true);
                    }
                    
                    // Upload file
                    if(move_uploaded_file($fileTmpName, $fileDestination)) {
                        $data['cv_file'] = $fileNameNew;
                    } else {
                        $data['cv_err'] = 'Error moving uploaded file';
                    }
                }
            }
            
            // Make sure errors are empty
            if(empty($data['motivation_err']) && empty($data['cv_err'])) {
                // Create application
                if($applicationModel->createApplication($data)) {
                    // Set flash message
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Your application has been submitted'
                    ];
                    
                    // Redirect to club page
                    header('Location: ' . BASE_URL . 'views\clubs\show.php' . $id);
                    exit();
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                require_once 'views\clubs\apply.php';
            }
        } else {
            // Init data
            $data = [
                'user_id' => $_SESSION['user_id'],
                'club_id' => $id,
                'motivation' => '',
                'cv_file' => '',
                'motivation_err' => '',
                'cv_err' => ''
            ];
            
            // Load view
            require_once 'views\clubs\apply.php';
        }
    }
}
