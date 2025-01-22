-- Author: Azminur Rahman, Saikot, Samiul, Joar
-- Last Modified: 2021-08-15
-- Description: SQL script to create the database and tables for the AgriPro project
-- Version: 1.0

CREATE DATABASE IF NOT EXISTS agripro;
USE agripro;

-- AZMINUR RAHMAN
-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_type ENUM('Admin', 'Advisor', 'Farmer') NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    profile_picture VARCHAR(255),
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- OTPs Table
CREATE TABLE IF NOT EXISTS otps (
    user_id INT PRIMARY KEY,
    otp_code VARCHAR(6),
    expires_at DATETIME,
    otp_count INT DEFAULT 0,
    is_used TINYINT(1) DEFAULT 1,
    generate_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_otps_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Help Requests Table
CREATE TABLE IF NOT EXISTS help_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    query_creator_id INT NOT NULL,
    feedbacker_id INT,
    category ENUM('General Support', 'Crop Health', 'Soil Health', 'Irrigation and Water Management', 'Farm Equipment and Technology') NOT NULL,
    query TEXT NOT NULL,
    feedback TEXT,
    feedback_status ENUM('Pending', 'Resolved') DEFAULT 'Pending',
    feedback_provided_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_help_requests_query_creator_id FOREIGN KEY (query_creator_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_help_requests_feedbacker_id FOREIGN KEY (feedbacker_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Trigger to Automatically Set Feedback Provided Time and Status
DELIMITER $$

CREATE TRIGGER set_feedback_status_and_time
BEFORE UPDATE ON help_requests
FOR EACH ROW
BEGIN
    IF NEW.feedback IS NOT NULL AND OLD.feedback IS NULL THEN
        SET NEW.feedback_provided_at = CURRENT_TIMESTAMP;
        SET NEW.feedback_status = 'Resolved';
    END IF;
END$$

DELIMITER ;

-- SAIKOT
-- Blogs Table
CREATE TABLE IF NOT EXISTS blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    summary VARCHAR(500) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_blogs_user_id FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Survey Feedback Table
CREATE TABLE IF NOT EXISTS survey_feedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    survay_feedbacker_id INT NOT NULL,
    satisfaction ENUM('satisfied','neutral','dissatisfied') NOT NULL,
    recommend ENUM('yes','no') NOT NULL,
    improvements TEXT NOT NULL,
    rating TINYINT(4) CHECK (rating BETWEEN 1 AND 5),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_survey_feedback_feedbacker_id FOREIGN KEY (survay_feedbacker_id) REFERENCES users(id) ON DELETE CASCADE
);

-- SAMIUL
-- Appointments Table
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    advisor_id INT NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    service VARCHAR(50) NOT NULL,
    details TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notified_admin TINYINT(1) DEFAULT 0,
    CONSTRAINT fk_appointments_user_id FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_appointments_advisor_id FOREIGN KEY (advisor_id) REFERENCES users(id)
);

-- Confirmed Appointments Table
-- Not used for auto increment on id
CREATE TABLE IF NOT EXISTS confirmed_appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    advisor_id INT NOT NULL,
    phone_number VARCHAR(20) DEFAULT NULL,
    appointment_date DATE DEFAULT NULL,
    appointment_time TIME DEFAULT NULL,
    service VARCHAR(255) DEFAULT NULL,
    details TEXT DEFAULT NULL,
    notified TINYINT(1) DEFAULT 0,
    notified_admin TINYINT(1) DEFAULT 0,
    CONSTRAINT fk_confirmed_appointments_user_id FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_confirmed_appointments_advisor_id FOREIGN KEY (advisor_id) REFERENCES users(id)
);

-- Updated Appointments Table with no auto increment on id
CREATE TABLE IF NOT EXISTS confirmed_appointments (
    id INT PRIMARY KEY, -- No AUTO_INCREMENT
    user_id INT NOT NULL,
    advisor_id INT NOT NULL,
    phone_number VARCHAR(20) DEFAULT NULL,
    appointment_date DATE DEFAULT NULL,
    appointment_time TIME DEFAULT NULL,
    service VARCHAR(255) DEFAULT NULL,
    details TEXT DEFAULT NULL,
    notified TINYINT(1) DEFAULT 0,
    notified_admin TINYINT(1) DEFAULT 0,
    CONSTRAINT fk_confirmed_appointments_user_id FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_confirmed_appointments_advisor_id FOREIGN KEY (advisor_id) REFERENCES users(id)
);


-- Notifications Table
CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    advisor_id INT NOT NULL,
    message VARCHAR(255) NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_notifications_advisor_id FOREIGN KEY (advisor_id) REFERENCES users(id) ON DELETE CASCADE
);

-- JOAR
-- Payments Table
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id INT NOT NULL,
    advisor_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_date DATETIME NOT NULL,
    CONSTRAINT fk_payments_farmer_id FOREIGN KEY (farmer_id) REFERENCES users(id),
    CONSTRAINT fk_payments_advisor_id FOREIGN KEY (advisor_id) REFERENCES users(id)
);

-- Terms & Conditions Table
CREATE TABLE IF NOT EXISTS terms_conditions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);