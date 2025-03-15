<?php
// File: controllers/ApplicationController.php
class ApplicationController {
    private $applicationModel;
    private $clubModel;
    
    public function __construct() {
        $this->applicationModel = new Application();
        $this->clubModel = new Club();
    }
    
    public function showForm($club_id = null) {
        if (!$club_id) {
            header('Location: index.php?page=clubs');
            exit;
        }
        
        // Check if club exists
        if (!$this->clubModel->getById($club_id)) {
            header('Location: index.php?page=clubs');
            exit;
        }
        
        $club = [
            'id' => $this->clubModel->id,
            'name' => $this->clubModel->name
        ];
        
        // Check if user already applied to this club
        if ($this->applicationModel->getByUserAndClub($_SESSION['user_id'], $club_id)) {
            $application = [
                'id' => $this->applicationModel->id,
                'status' => $this->applicationModel->status,
                'created_at' => $this->applicationModel->created_at
            ];
        }
        
        // Include the view
        include 'views/applications/apply.php';
    }
    
    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=clubs');
            exit;
        }
        
        // Validate input
        $errors = [];
        
        if (empty($_POST['club_id'])) {
            $errors[] = "Club is required";
        }
        
        if (empty($_POST['motivation'])) {
            $errors[] = "Motivation is required";
        }
        
        // Check if CV file is uploaded
        if (empty($_FILES['cv_file']['name'])) {
            $errors[] = "CV is required";
        } else {
            // Validate file type
            $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (!in_array($_FILES['cv_file']['type'], $allowedTypes)) {
                $errors[] = "Invalid file type. Only PDF and Word documents are allowed";
            }
            
            // Validate file size (max 5MB)
            if ($_FILES['cv_file']['size'] > 5000000) {
                $errors[] = "File is too large. Maximum size is 5MB";
            }
        }
        
        // Check if user already applied to this club
        if ($this->applicationModel->getByUserAndClub($_SESSION['user_id'], $_POST['club_id'])) {
            $errors[] = "You have already applied to this club";
        }
        
        if (empty($errors)) {
            // Upload CV file
            $targetDir = "public/uploads/cv/";
            $fileName = uniqid() . "_" . basename($_FILES["cv_file"]["name"]);
            $targetFile = $targetDir . $fileName;
            
            if (is_writable($targetDir) && move_uploaded_file($_FILES["cv_file"]["tmp_name"], $targetFile)) {
                // Create application
                $this->applicationModel->user_id = $_SESSION['user_id'];
                $this->applicationModel->club_id = $_POST['club_id'];
                $this->applicationModel->motivation = $_POST['motivation'];
                $this->applicationModel->cv_file = $fileName;
                
                if ($this->applicationModel->create()) {
                    // Redirect to club detail
                    header('Location: index.php?page=clubs&action=detail&id=' . $_POST['club_id'] . '&success=1');
                    exit;
                } else {
                    $errors[] = "Something went wrong";
                }
            } else {
                $errors[] = "Error uploading file. Ensure the upload directory is writable.";
            }
        }
        
        // If there are errors, show form again
        if (!empty($errors)) {
            // Get club info
            $this->clubModel->getById($_POST['club_id']);
            $club = [
                'id' => $this->clubModel->id,
                'name' => $this->clubModel->name
            ];
            
            include 'views/applications/apply.php';
        }
    }
}