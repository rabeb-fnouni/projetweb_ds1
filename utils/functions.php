<?php
// File: utils/functions.php

/**
 * Format date to a readable format
 * 
 * @param string $date Date string
 * @return string Formatted date
 */
function formatDate($date) {
    return date('F j, Y', strtotime($date));
}

/**
 * Get status badge HTML
 * 
 * @param string $status Status (pending, approved, rejected)
 * @return string HTML for the badge
 */
function getStatusBadge($status) {
    $colors = [
        'pending' => 'bg-warning',
        'approved' => 'bg-success',
        'rejected' => 'bg-danger'
    ];
    
    $labels = [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected'
    ];
    
    $color = isset($colors[$status]) ? $colors[$status] : 'bg-secondary';
    $label = isset($labels[$status]) ? $labels[$status] : ucfirst($status);
    
    return '<span class="badge ' . $color . '">' . $label . '</span>';
}

/**
 * Check if user has already applied to a club
 * 
 * @param int $user_id User ID
 * @param int $club_id Club ID
 * @return bool True if applied, false otherwise
 */
function hasApplied($user_id, $club_id) {
    $application = new Application();
    return $application->getByUserAndClub($user_id, $club_id);
}

/**
 * Get application status for user and club
 * 
 * @param int $user_id User ID
 * @param int $club_id Club ID
 * @return string Status or empty string if not applied
 */
function getApplicationStatus($user_id, $club_id) {
    $application = new Application();
    if ($application->getByUserAndClub($user_id, $club_id)) {
        return $application->status;
    }
    return '';
}