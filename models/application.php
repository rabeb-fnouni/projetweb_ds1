<?php
// models/Application.php

class Application {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Create application
    public function createApplication($data) {
        $this->db->query('INSERT INTO applications (user_id, club_id, cv_file, motivation, status) 
                          VALUES (:user_id, :club_id, :cv_file, :motivation, :status)');
        
        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':club_id', $data['club_id']);
        $this->db->bind(':cv_file', $data['cv_file']);
        $this->db->bind(':motivation', $data['motivation']);
        $this->db->bind(':status', $data['status'] ?? 'pending');
        
        // Execute
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    // Get all applications
    public function getApplications() {
        $this->db->query('SELECT a.*, u.full_name, u.email, c.name as club_name 
                          FROM applications a 
                          JOIN users u ON a.user_id = u.id 
                          JOIN clubs c ON a.club_id = c.id 
                          ORDER BY a.created_at DESC');
        
        return $this->db->resultSet();
    }
    
    // Get application by ID
    public function getApplicationById($id) {
        $this->db->query('SELECT a.*, u.full_name, u.email, c.name as club_name 
                          FROM applications a 
                          JOIN users u ON a.user_id = u.id 
                          JOIN clubs c ON a.club_id = c.id 
                          WHERE a.id = :id');
        $this->db->bind(':id', $id);
        
        return $this->db->single();
    }
    
    // Get applications by club
    public function getApplicationsByClub($clubId) {
        $this->db->query('SELECT a.*, u.full_name, u.email 
                          FROM applications a 
                          JOIN users u ON a.user_id = u.id 
                          WHERE a.club_id = :club_id 
                          ORDER BY a.created_at DESC');
        $this->db->bind(':club_id', $clubId);
        
        return $this->db->resultSet();
    }
    
    // Get applications by user
    public function getApplicationsByUser($userId) {
        $this->db->query('SELECT a.*, c.name as club_name 
                          FROM applications a 
                          JOIN clubs c ON a.club_id = c.id 
                          WHERE a.user_id = :user_id 
                          ORDER BY a.created_at DESC');
        $this->db->bind(':user_id', $userId);
        
        return $this->db->resultSet();
    }
    
    // Update application status
    public function updateStatus($id, $status) {
        $this->db->query('UPDATE applications SET status = :status, updated_at = CURRENT_TIMESTAMP 
                          WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Delete application
    public function deleteApplication($id) {
        $this->db->query('DELETE FROM applications WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Check if user already applied to a club
    public function hasApplied($userId, $clubId) {
        $this->db->query('SELECT COUNT(*) as total FROM applications 
                          WHERE user_id = :user_id AND club_id = :club_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':club_id', $clubId);
        
        $result = $this->db->single();
        return $result->total > 0;
    }
    
    // Count all applications
    public function countApplications() {
        $this->db->query('SELECT COUNT(*) as total FROM applications');
        $result = $this->db->single();
        return $result->total;
    }
    
    // Count pending applications
    public function countPendingApplications() {
        $this->db->query('SELECT COUNT(*) as total FROM applications WHERE status = "pending"');
        $result = $this->db->single();
        return $result->total;
    }
}
