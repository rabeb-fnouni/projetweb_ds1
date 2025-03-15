<?php
// models/Event.php

class Event {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Create event
    public function createEvent($data) {
        $this->db->query('INSERT INTO events (club_id, title, description, location, event_date) 
                          VALUES (:club_id, :title, :description, :location, :event_date)');
        
        // Bind values
        $this->db->bind(':club_id', $data['club_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':event_date', $data['event_date']);
        
        // Execute
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    // Get all events
    public function getEvents() {
        $this->db->query('SELECT e.*, c.name as club_name 
                          FROM events e 
                          JOIN clubs c ON e.club_id = c.id 
                          ORDER BY e.event_date DESC');
        
        return $this->db->resultSet();
    }
    
    // Get upcoming events
    public function getUpcomingEvents() {
        $this->db->query('SELECT e.*, c.name as club_name 
                          FROM events e 
                          JOIN clubs c ON e.club_id = c.id 
                          WHERE e.event_date >= CURDATE() 
                          ORDER BY e.event_date ASC');
        
        return $this->db->resultSet();
    }
    
    // Get event by ID
    public function getEventById($id) {
        $this->db->query('SELECT e.*, c.name as club_name 
                          FROM events e 
                          JOIN clubs c ON e.club_id = c.id 
                          WHERE e.id = :id');
        $this->db->bind(':id', $id);
        
        return $this->db->single();
    }
    
    // Get events by club
    public function getEventsByClub($clubId) {
        $this->db->query('SELECT * FROM events 
                          WHERE club_id = :club_id 
                          ORDER BY event_date DESC');
        $this->db->bind(':club_id', $clubId);
        
        return $this->db->resultSet();
    }
    
    // Update event
    public function updateEvent($data) {
        $this->db->query('UPDATE events 
                          SET club_id = :club_id, title = :title, description = :description, 
                          location = :location, event_date = :event_date 
                          WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':club_id', $data['club_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':event_date', $data['event_date']);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Delete event
    public function deleteEvent($id) {
        $this->db->query('DELETE FROM events WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Count events
    public function countEvents() {
        $this->db->query('SELECT COUNT(*) as total FROM events');
        $result = $this->db->single();
        return $result->total;
    }
    
    // Count upcoming events
    public function countUpcomingEvents() {
        $this->db->query('SELECT COUNT(*) as total FROM events WHERE event_date >= CURDATE()');
        $result = $this->db->single();
        return $result->total;
    }
}
