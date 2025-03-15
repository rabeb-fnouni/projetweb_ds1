<?php
// File: controllers/AdminController.php
class AdminController {
    private $statModel;
    private $applicationModel;
    
    public function __construct() {
        $this->statModel = new Stat();
        $this->applicationModel = new Application();
    }
    
    public function dashboard() {
        // Get clubs with application counts
        $result = $this->statModel->getClubStats();
        $clubStats = [];
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $clubStats[] = $row;
        }
        
        // Include the view
        include 'views/admin/dashboard.php';
    }
    
    public function showStats() {
        // Get overall statistics
        $stats = $this->statModel->getTotalStats();
        
        // Get club statistics
        $result = $this->statModel->getClubStats();
        $clubStats = [];
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $clubStats[] = $row;
        }
        
        // Include the view
        include 'views/admin/stats.php';
    }
    
    public function handleApplication($id, $status) {
        if ($this->applicationModel->updateStatus($id, $status)) {
            return true;
        }
        return false;
    }
}