-- Create and use the database

USE mydb;

-- Create Users table
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Projects table
CREATE TABLE IF NOT EXISTS projects (
    project_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Create Tasks table
CREATE TABLE IF NOT EXISTS tasks (
    task_id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT,
    title VARCHAR(100) NOT NULL,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    due_date DATE,
    FOREIGN KEY (project_id) REFERENCES projects(project_id)
);

/*

-- Insert sample data
INSERT INTO users (username, email, password_hash) VALUES
('john_doe', 'john@example.com', 'hashed_password_1'),
('jane_smith', 'jane@example.com', 'hashed_password_2');

INSERT INTO projects (user_id, title, description) VALUES
(1, 'Portfolio Website', 'Personal portfolio website development'),
(2, 'E-commerce Site', 'Online store for digital products');

INSERT INTO tasks (project_id, title, status, due_date) VALUES
(1, 'Design Homepage', 'in_progress', '2024-04-15'),
(1, 'Implement Contact Form', 'pending', '2024-04-20'),
(2, 'Setup Payment Gateway', 'pending', '2024-04-25');
*/