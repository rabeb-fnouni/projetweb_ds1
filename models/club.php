<?php
// File: models/Club.php
class Club {
    private $conn;
    private $table = 'clubs';
    
    public $id;
    public $name;
    public $description;
    public $foundation_date;
    public $logo;
    public $social_facebook;
    public $social_instagram;
    public $social_twitter;
    public $created_at;
    
    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }
    
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->foundation_date = $row['foundation_date'];
            $this->logo = $row['logo'];
            $this->social_facebook = $row['social_facebook'];
            $this->social_instagram = $row['social_instagram'];
            $this->social_twitter = $row['social_twitter'];
            $this->created_at = $row['created_at'];
            return true;
        }
        
        return false;
    }
    
    public function getMemberCount($club_id) {
        $query = "SELECT COUNT(*) as total FROM applications WHERE club_id = :club_id AND status = 'approved'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':club_id', $club_id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
    
    public function getApplicationCount($club_id, $status = null) {
        $query = "SELECT COUNT(*) as total FROM applications WHERE club_id = :club_id";
        
        if ($status) {
            $query .= " AND status = :status";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':club_id', $club_id);
        
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}