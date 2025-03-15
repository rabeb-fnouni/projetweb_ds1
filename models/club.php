<?php
// models/Club.php

class Club {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Get all clubs
    public function getClubs() {
        $this->db->query('SELECT * FROM clubs ORDER BY name ASC');
        
        return $this->db->resultSet();
    }
    
    // Get club by ID
    public function getClubById($id) {
        $this->db->query('SELECT * FROM clubs WHERE id = :id');
        $this->db->bind(':id', $id);
        
        return $this->db->single();
    }
    
    // Create club
    public function createClub($data) {
        $this->db->query('INSERT INTO clubs (name, description, foundation_date, logo, facebook_link, 
                          instagram_link, twitter_link, linkedin_link, email) 
                          VALUES (:name, :description, :foundation_date, :logo, :facebook_link, 
                          :instagram_link, :twitter_link, :linkedin_link, :email)');
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':foundation_date', $data['foundation_date']);
        $this->db->bind(':logo', $data['logo']);
        $this->db->bind(':facebook_link', $data['facebook_link']);
        $this->db->bind(':instagram_link', $data['instagram_link']);
        $this->db->bind(':twitter_link', $data['twitter_link']);
        $this->db->bind(':linkedin_link', $data['linkedin_link']);
        $this->db->bind(':email', $data['email']);
        
        // Execute
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    // Update club
    public function updateClub($data) {
        $this->db->query('UPDATE clubs SET name = :name, description = :description, 
                          foundation_date = :foundation_date, logo = :logo, facebook_link = :facebook_link, 
                          instagram_link = :instagram_link, twitter_link = :twitter_link, 
                          linkedin_link = :linkedin_link, email = :email 
                          WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':foundation_date', $data['foundation_date']);
        $this->db->bind(':logo', $data['logo']);
        $this->db->bind(':facebook_link', $data['facebook_link']);
        $this->db->bind(':instagram_link', $data['instagram_link']);
        $this->db->bind(':twitter_link', $data['twitter_link']);
        $this->db->bind(':linkedin_link', $data['linkedin_link']);
        $this->db->bind(':email', $data['email']);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Delete club
    public function deleteClub($id) {
        $this->db->query('DELETE FROM clubs WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Count clubs
    public function countClubs() {
        $this->db->query('SELECT COUNT(*) as total FROM clubs');
        $result = $this->db->single();
        return $result->total;
    }
    
    // Get club members count
    public function getMembersCount($clubId) {
        $this->db->query('SELECT COUNT(*) as total FROM club_members WHERE club_id = :club_id');
        $this->db->bind(':club_id', $clubId);
        
        $result = $this->db->single();
        return $result->total;
    }
    
    // Get club applications count
    public function getApplicationsCount($clubId) {
        $this->db->query('SELECT COUNT(*) as total FROM applications WHERE club_id = :club_id');
        $this->db->bind(':club_id', $clubId);
        
        $result = $this->db->single();
        return $result->total;
    }
    
    // Get pending applications count
    public function getPendingApplicationsCount($clubId) {
        $this->db->query('SELECT COUNT(*) as total FROM applications WHERE club_id = :club_id AND status = "pending"');
        $this->db->bind(':club_id', $clubId);
        
        $result = $this->db->single();
        return $result->total;
    }
    
    // Get club events count
    public function getEventsCount($clubId) {
        $this->db->query('SELECT COUNT(*) as total FROM events WHERE club_id = :club_id');
        $this->db->bind(':club_id', $clubId);
        
        $result = $this->db->single();
        return $result->total;
    }
    
    // Check if club exists
    public function clubExists($id) {
        $this->db->query('SELECT COUNT(*) as total FROM clubs WHERE id = :id');
        $this->db->bind(':id', $id);
        
        $result = $this->db->single();
        return $result->total > 0;
    }
}
