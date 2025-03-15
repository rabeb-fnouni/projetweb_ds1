<?php
// models/Stats.php

class Stats {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Get club membership statistics
    public function getClubMembershipStats() {
        $this->db->query('SELECT c.id, c.name, COUNT(m.id) as member_count 
                          FROM clubs c 
                          LEFT JOIN club_members m ON c.id = m.club_id 
                          GROUP BY c.id 
                          ORDER BY member_count DESC');
        
        return $this->db->resultSet();
    }
    
    // Get club application statistics
    public function getClubApplicationStats() {
        $this->db->query('SELECT c.id, c.name, 
                         COUNT(a.id) as total_applications,
                         SUM(CASE WHEN a.status = "pending" THEN 1 ELSE 0 END) as pending_applications,
                         SUM(CASE WHEN a.status = "approved" THEN 1 ELSE 0 END) as approved_applications,
                         SUM(CASE WHEN a.status = "rejected" THEN 1 ELSE 0 END) as rejected_applications
                         FROM clubs c
                         LEFT JOIN applications a ON c.id = a.club_id
                         GROUP BY c.id
                         ORDER BY total_applications DESC');
        
        return $this->db->resultSet();
    }
    
    // Get monthly application statistics
    public function getMonthlyApplicationStats() {
        $this->db->query('SELECT 
                         DATE_FORMAT(created_at, "%Y-%m") as month,
                         COUNT(*) as total_applications,
                         SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending_applications,
                         SUM(CASE WHEN status = "approved" THEN 1 ELSE 0 END) as approved_applications,
                         SUM(CASE WHEN status = "rejected" THEN 1 ELSE 0 END) as rejected_applications
                         FROM applications
                         GROUP BY DATE_FORMAT(created_at, "%Y-%m")
                         ORDER BY month DESC');
        
        return $this->db->resultSet();
    }
    
    // Get event statistics
    public function getEventStats() {
        $this->db->query('SELECT c.id, c.name, COUNT(e.id) as event_count 
                          FROM clubs c 
                          LEFT JOIN events e ON c.id = e.club_id 
                          GROUP BY c.id 
                          ORDER BY event_count DESC');
        
        return $this->db->resultSet();
    }
    
    // Get overall statistics
    public function getOverallStats() {
        $stats = new \stdClass();
        
        // Count total students
        $this->db->query('SELECT COUNT(*) as total FROM users WHERE role = "student"');
        $result = $this->db->single();
        $stats->total_students = $result->total;
        
        // Count total clubs
        $this->db->query('SELECT COUNT(*) as total FROM clubs');
        $result = $this->db->single();
        $stats->total_clubs = $result->total;
        
        // Count total members
        $this->db->query('SELECT COUNT(*) as total FROM club_members');
        $result = $this->db->single();
        $stats->total_members = $result->total;
        
        // Count total applications
        $this->db->query('SELECT COUNT(*) as total FROM applications');
        $result = $this->db->single();
        $stats->total_applications = $result->total;
        
        // Count pending applications
        $this->db->query('SELECT COUNT(*) as total FROM applications WHERE status = "pending"');
        $result = $this->db->single();
        $stats->pending_applications = $result->total;
        
        // Count total events
        $this->db->query('SELECT COUNT(*) as total FROM events');
        $result = $this->db->single();
        $stats->total_events = $result->total;
        
        // Count upcoming events
        $this->db->query('SELECT COUNT(*) as total FROM events WHERE event_date >= CURDATE()');
        $result = $this->db->single();
        $stats->upcoming_events = $result->total;
        
        return $stats;
    }
}
