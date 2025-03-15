<?php
// controllers/HomeController.php

class HomeController {
    private $clubModel;
    private $eventModel;
    
    public function __construct() {
        $this->clubModel = new Club();
        $this->eventModel = new Event();
    }
    
    // Index page
    public function index() {
        // Get all clubs
        $clubs = $this->clubModel->getClubs();
        
        // Get upcoming events
        $events = $this->eventModel->getUpcomingEvents();
        
        // Load view
        require_once 'views\home\index.php';
    }
    
    // About page
    public function about() {
        // Load view
        require_once 'views\home\index.php';
    }
    
    // Contact page
    public function contact() {
        // Load view
        require_once 'views\home\contact.php';
    }
    
    // Send contact form
    public function sendContact() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'message' => trim($_POST['message']),
                'name_err' => '',
                'email_err' => '',
                'message_err' => ''
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter your name.';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter your email.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter a valid email address.';
            }

            // Validate message
            if (empty($data['message'])) {
                $data['message_err'] = 'Please enter your message.';
            }

            // Check for errors
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['message_err'])) {
                // Here you can implement the logic to send the email
                // For example, using the mail() function or a library like PHPMailer

                // Example using mail() function (make sure your server is configured to send emails)
                $to = 'your_email@example.com'; // Replace with your email address
                $subject = 'Contact Form Submission from ' . $data['name'];
                $body = "Name: " . $data['name'] . "\nEmail: " . $data['email'] . "\nMessage:\n" . $data['message'];
                $headers = "From: " . $data['email'];

                if (mail($to, $subject, $body, $headers)) {
                    // Set flash message for success
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Your message has been sent successfully!'
                    ];
                } else {
                    // Set flash message for failure
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'There was an error sending your message. Please try again later.'
                    ];
                }

                // Redirect back to the contact page
                header('Location: ' . BASE_URL . 'views\home\contact.php');
                exit();
            } else {
                // Load the contact view with errors
                require_once 'views\home\contact.php';
            }
        } else {
            // Redirect to the contact page if not a POST request
            header('Location: ' . BASE_URL . '/views\home\contact.php');
            exit();
        }
    }
}
?>
