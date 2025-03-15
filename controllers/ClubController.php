<?php
// File: controllers/ClubController.php
class ClubController {
    private $clubModel;
    
    public function __construct() {
        $this->clubModel = new Club();
    }
    
    public function index() {
        // Get all clubs
        $result = $this->clubModel->getAll();
        $clubs = [];
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $clubs[] = $row;
        }
        
        // Include the view
        include 'views/clubs/index.php';
    }
    
    public function show($id) {
        // Get club by ID
        if ($this->clubModel->getById($id)) {
            $club = [
                'id' => $this->clubModel->id,
                'name' => $this->clubModel->name,
                'description' => $this->clubModel->description,
                'foundation_date' => $this->clubModel->foundation_date,
                'logo' => $this->clubModel->logo,
                'social_facebook' => $this->clubModel->social_facebook,
                'social_instagram' => $this->clubModel->social_instagram,
                'social_twitter' => $this->clubModel->social_twitter
            ];
            
            // Get member count
            $memberCount = $this->clubModel->getMemberCount($id);
            
            // Include the view
            include 'views/clubs/detail.php';
        } else {
            // Club not found
            header('Location: index.php?page=clubs');
            exit;
        }
    }
}