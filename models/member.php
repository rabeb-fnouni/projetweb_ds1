<?php
// models/Member.php

class Member {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Add member
    public function addMember($data) {
        $this->db->query('INSERT INTO club_members (user_id, club_id, role) 
                          VALUES (:user_id, :club_id, :role)');
        
        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':club_id', $data['club_id']);
        $this->db->bind(':role', $data['role'] ?? 'member');
        
        // Execute
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    // Get all members
    public function getMembers() {
        $this->db->query('SELECT m.*, u.full_name, u.email, c.name as club_name 
                          FROM club_members m 
                          JOIN users u ON m.user_id = u.id 
                          JOIN clubs c ON m.club_id = c.id 
                          ORDER BY c.name ASC, m.role ASC');
        
        return $this->db->resultSet();
    }
    
    // Get members by club
    public function getMembersByClub($clubId) {
        $this->db->query('SELECT m.*, u.full_name, u.email 
                          FROM club_members m 
                          JOIN users u ON m.user_id = u.id 
                          WHERE m.club_id = :club_id 
                          ORDER BY m.role ASC');
        $this->db->bind(':club_id', $clubId);
        
        return $this->db->resultSet();
    }
    
    public function getClubsByUser($userId) {
        $this->db->query('SELECT m.*, c.name, c.logo 
                          FROM club_members m 
                          JOIN clubs c ON m.club_id = c.id 
                          WHERE m.user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        
        return $this->db->resultSet();
    }
    
    // Check if user is member of club
    public function isMember($userId, $clubId) {
        $this->db->query('SELECT COUNT(*) as total FROM club_members 
                          WHERE user_id = :user_id AND club_id = :club_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':club_id', $clubId);
        
        $result = $this->db->single();
        return $result->total > 0;
    }
    
    // Update member role
    public function updateRole($userId, $clubId, $role) {
        $this->db->query('UPDATE club_members SET role = :role 
                          WHERE user_id = :user_id AND club_id = :club_id');
        
        // Bind values
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':club_id', $clubId);
        $this->db->bind(':role', $role);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Remove member
    public function removeMember($userId, $clubId) {
        $this->db->query('DELETE FROM club_members 
                          WHERE user_id = :user_id AND club_id = :club_id');
        
        // Bind values
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':club_id', $clubId);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Count members
    public function countMembers() {
        $this->db->query('SELECT COUNT(*) as total FROM club_members');
        $result = $this->db->single();
        return $result->total;
    }
    
    // Count members by club
    public function countMembersByClub($clubId) {
        $this->db->query('SELECT COUNT(*) as total FROM club_members 
                          WHERE club_id = :club_id');
        $this->db->bind(':club_id', $clubId);
        
        $result = $this->db->single();
        return $result->total;
    }
}
?>