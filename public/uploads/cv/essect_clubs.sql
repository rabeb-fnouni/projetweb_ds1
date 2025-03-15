-- Create the database
CREATE DATABASE IF NOT EXISTS essect_clubs_db;
USE essect_clubs_db;

-- Users table (students and admins)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    role ENUM('student', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Clubs table
CREATE TABLE IF NOT EXISTS clubs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    foundation_date DATE NOT NULL,
    logo VARCHAR(255),
    facebook_link VARCHAR(255),
    instagram_link VARCHAR(255),
    twitter_link VARCHAR(255),
    linkedin_link VARCHAR(255),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Club membership table
CREATE TABLE IF NOT EXISTS club_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    club_id INT NOT NULL,
    role ENUM('member', 'leader', 'vice_leader', 'secretary', 'treasurer') DEFAULT 'member',
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (club_id) REFERENCES clubs(id) ON DELETE CASCADE,
    UNIQUE KEY unique_membership (user_id, club_id)
);

-- Application table for club membership requests
CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    club_id INT NOT NULL,
    cv_file VARCHAR(255) NOT NULL,
    motivation TEXT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (club_id) REFERENCES clubs(id) ON DELETE CASCADE
);

-- Events table for club events
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    club_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(100),
    event_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (club_id) REFERENCES clubs(id) ON DELETE CASCADE
);

-- Insert clubs
INSERT INTO clubs (name, description, foundation_date, logo, facebook_link, instagram_link, twitter_link, linkedin_link, email) VALUES
('Enactus', 'Enactus is an international nonprofit organization dedicated to inspiring students to improve the world through entrepreneurial action.', '2010-09-01', 'enactus.png', 'https://www.facebook.com/ Enactus ESSEC Tunis', 'https://www.instagram.com/enactors.essect', 'https://twitter.com/EnactusESSECT', 'https://www.linkedin.com/company/enactus-essect', 'enactus@essect.u-tunis.tn'),
('InfoLab', 'InfoLab is a technology club focused on developing technical skills in programming, AI, and data science.', '2022-09-25', 'infolab.png', 'https://www.facebook.com/InfoLabESSECT', 'https://www.instagram.com/infolab_essect', 'https://twitter.com/InfoLabESSECT', 'https://www.linkedin.com/company/infolab-essect', 'infolab@essect.u-tunis.tn'),
('Radio', 'Radio ESSECT is the university radio club dedicated to broadcasting news, music, and educational content.', '2024-12-13', 'radio.png', 'https://www.facebook.com/RadioESSECT', 'https://www.instagram.com/radio_essect', 'https://twitter.com/RadioESSECT', 'https://www.linkedin.com/company/radio-essect', 'radioessect@essect.u-tunis.tn');

-- Insert admin user (password: admin123)
INSERT INTO users (username, email, password, full_name, student_id, role) VALUES
('admin-infolab', 'admininfolab@essect.u-tunis.tn', '$2y$10$8vCuSjkds2GdZjUQlE5PQ.rPCp9gCuq1WMRspJym4xEjNPw7t4IPS', 'Nour Cherni', 'ADMIN001', 'admin'),
('admin-radio', 'adminradio@essect.u-tunis.tn', '$2y$10$8vCuSjkds2GdZjUQlE5PQ.rPCp9gCuq1WMRspJym4xEjNPw7t4IPS', 'Abedlkrim oucema', 'ADMIN002', 'admin'),
('admin_enactus', 'adminenactus@essect.u-tunis.tn', '$2y$10$8vCuSjkds2GdZjUQlE5PQ.rPCp9gCuq1WMRspJym4xEjNPw7t4IPS', 'Rayen Souli', 'ADMIN003', 'admin');
-- Insert mock student users
INSERT INTO users (username, email, password, full_name, student_id, role) VALUES
('student1', 'student1@essect.u-.tunis.tn','10$8vCuSjkds2GdZjUQlE5PQ.rPCp9gCuq1WMRspJym4xEjNPw7t4IPS', 'Student One', 'STU001', 'student'),
('student2', 'student2essect.u-.tunis.tn', '$2y$10$8vCuSjkds2GdZjUQlE5PQ.rPCp9gCuq1WMRspJym4xEjNPw7t4IPS', 'Student Two', 'STU002', 'student'),
('student3', 'student3essect.u-.tunis.tn', '$2y$10$8vCuSjkds2GdZjUQlE5PQ.rPCp9gCuq1WMRspJym4xEjNPw7t4IPS', 'Student Three', 'STU003', 'student');

-- Insert applications
INSERT INTO applications (user_id, club_id, cv_file, motivation, status) VALUES
(2, 1, 'cv_student1.pdf', 'I am passionate about social entrepreneurship.', 'pending'),
(3, 2, 'cv_student2.pdf', 'I want to enhance my programming skills.', 'pending'),
(2, 3, 'cv_student3.pdf', 'I love music and want to be part of the radio team.', 'pending');

-- Insert  events
INSERT INTO events (club_id, title, description, location, event_date) VALUES
(1, 'Internation Entrepeneurship week','A  meet and greet with young entreprenors who pathed their way ','Amphi 1','2024-11-20 12:00:00'),
(1, 'Internation Entrepeneurship week','A  meet and greet with young entreprenors who pathed their way ','Amphi 1','2023-11- 12:00:00'),
(1, 'Enactus Football ChampionShip',' enactus teams from tunisia come together for an inforgettable football competition','Olympic Sky Stadium','2024-11-12 09:00:00'),
(1, 'Enactus Essect Anniversary','celebrating another year on innovative projects and positive social impact','villa','2024-11-20 12:00:00'),
(1, 'Enactus Essect Anniversary','celebrating another year on innovative projects and positive social impact','villa','2023-11-20 19:00:00'),
(2, 'Reussir mon PFE', 'A workshop on how to ace your final year project', 'Amphi 1', '2024-11-23 08:30:00'),
(2, 'events manegement','A workshop on events manegement','Amphi 1', '2025-02-27 08:00:00'),
(2, 'AI-Enhanced Personal Branding', 'A workshop on how to build a personal Brand optimize linkedin and leveraging AI for Strategic Networking and Digial Idenity', 'Amphi 2', '2024-11-13 13:30:00'),
(2, 'Google conference', 'Descover google oeed programs', 'Amphi 2', '2024-02-28 13:30:00'),
(2, 'Digital Marketing in the area of AI ', 'Descover new opportunities in the digital marketing field using AI technologies', 'Amphi 2', '2023-02-12 13:00:00'),
(2, 'initiation a github','A workshop on GitHub','Amphi 2', '2022-11-23 13:00:00'),
(3, 'Radio ESSECT Live Show', 'Join us for a live broadcast.', 'Studio 1', '2023-12-01 18:00:00');