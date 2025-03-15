<?php
// File: models/Stat.php
class Stat {
    private $conn;
    
    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }
    
    public function getClubStats() {
        $query = "SELECT c.id, c.name, 
                 (SELECT COUNT(*) FROM applications WHERE club_id = c.id AND status = 'approved') as member_count,
                 (SELECT COUNT(*) FROM applications WHERE club_id = c.id) as application_count,
                 (SELECT COUNT(*) FROM applications WHERE club_id = c.id AND status = 'pending') as pending_count
                 FROM clubs c
                 ORDER BY c.name ASC";
                 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    public function getTotalStats() {
        $stats = array();
        
        // Total users
        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'student'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['total_students'] = $row['total'];
        
        // Total clubs
        $query = "SELECT COUNT(*) as total FROM clubs";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['total_clubs'] = $row['total'];
        
        // Total applications
        $query = "SELECT COUNT(*) as total FROM applications";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['total_applications'] = $row['total'];
        
        // Applications by status
        $query = "SELECT status, COUNT(*) as total FROM applications GROUP BY status";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stats['status_' . $row['status']] = $row['total'];
        }
        
        return $stats;
    }
}
