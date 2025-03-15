<?php
// models/User.php

class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Register user
    public function register($data) {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Insert user
        $this->db->query('INSERT INTO users (username, email, password, full_name, student_id, role) 
                          VALUES (:username, :email, :password, :full_name, :student_id, :role)');
        
        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':role', $data['role'] ?? 'student');
        
        // Execute
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    // Login user
    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        
        $row = $this->db->single();
        
        if($row) {
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)) {
                return $row;
            }
        }
        
        return false;
    }
    
    // Find user by ID
    public function findUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        
        $row = $this->db->single();
        
        return $row;
    }
    
    // Find user by email
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        // Check if row exists
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Find user by username
    public function findUserByUsername($username) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        
        $row = $this->db->single();
        
        // Check if row exists
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Find user by student ID
    public function findUserByStudentId($student_id) {
        $this->db->query('SELECT * FROM users WHERE student_id = :student_id');
        $this->db->bind(':student_id', $student_id);
        
        $row = $this->db->single();
        
        // Check if row exists
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getUsers() {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        
        return $this->db->resultSet();
    }
    
    // Get all students
    public function getStudents() {
        $this->db->query('SELECT * FROM users WHERE role = "student" ORDER BY created_at DESC');
        
        return $this->db->resultSet();
    }
    
    // Update user
    public function updateUser($data) {
        $this->db->query('UPDATE users SET username = :username, email = :email, full_name = :full_name 
                          WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':full_name', $data['full_name']);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Change password
    public function changePassword($userId, $newPassword) {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        
        // Hash password
        $password = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Bind values
        $this->db->bind(':id', $userId);
        $this->db->bind(':password', $password);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Delete user
    public function deleteUser($id) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Count users
    public function countUsers() {
        $this->db->query('SELECT COUNT(*) as total FROM users');
        $result = $this->db->single();
        return $result->total;
    }
    
    // Count students
    public function countStudents() {
        $this->db->query('SELECT COUNT(*) as total FROM users WHERE role = "student"');
        $result = $this->db->single();
        return $result->total;
    }
}
?>