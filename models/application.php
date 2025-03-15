<?php
// File: models/Application.php
class Application {
    private $conn;
    private $table = 'applications';
    
    public $id;
    public $user_id;
    public $club_id;
    public $motivation;
    public $cv_file;
    public $status; // pending, approved, rejected
    public $created_at;
    
    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }
    
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  SET user_id = :user_id, 
                      club_id = :club_id, 
                      motivation = :motivation, 
                      cv_file = :cv_file, 
                      status = 'pending', 
                      created_at = NOW()";
        
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->club_id = htmlspecialchars(strip_tags($this->club_id));
        $this->motivation = htmlspecialchars(strip_tags($this->motivation));
        $this->cv_file = htmlspecialchars(strip_tags($this->cv_file));
        
        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':club_id', $this->club_id);
        $stmt->bindParam(':motivation', $this->motivation);
        $stmt->bindParam(':cv_file', $this->cv_file);
        
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        
        return false;
    }
    
    public function getAllByClub($club_id) {
        $query = "SELECT a.*, u.name as user_name, u.email as user_email 
                  FROM " . $this->table . " a
                  LEFT JOIN users u ON a.user_id = u.id
                  WHERE a.club_id = :club_id
                  ORDER BY a.created_at DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':club_id', $club_id);
        $stmt->execute();
        
        return $stmt;
    }
    
    public function getByUserAndClub($user_id, $club_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE user_id = :user_id AND club_id = :club_id 
                  LIMIT 0,1";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':club_id', $club_id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->id = $row['id'];
            $this->user_id = $row['user_id'];
            $this->club_id = $row['club_id'];
            $this->motivation = $row['motivation'];
            $this->cv_file = $row['cv_file'];
            $this->status = $row['status'];
            $this->created_at = $row['created_at'];
            return true;
        }
        
        return false;
    }
    
    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table . " 
                  SET status = :status 
                  WHERE id = :id";
                  
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $status = htmlspecialchars(strip_tags($status));
        $id = htmlspecialchars(strip_tags($id));
        
        // Bind data
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>