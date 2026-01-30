-- Database Schema for Online Quiz Management System

CREATE DATABASE IF NOT EXISTS quiz_db;
USE quiz_db;

-- Users Table (Admin and Student)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Quizzes Table
CREATE TABLE IF NOT EXISTS quizzes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    time_limit INT NOT NULL COMMENT 'Time in minutes',
    total_marks INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Questions Table
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    correct_option ENUM('a', 'b', 'c', 'd') NOT NULL,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

-- Results/Attempts Table
CREATE TABLE IF NOT EXISTS attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    score INT NOT NULL,
    total_marks INT NOT NULL,
    attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

-- Insert a default admin user (Password: admin123)
-- Note: In a real app, passwords should be hashed using password_hash(). 
-- For this demo, we'll store them plainly or hash them later in the register script. 
-- Here is a hashed version of 'admin123' just in case.
INSERT INTO users (name, email, password, role) VALUES 
('Administrator', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
