CREATE DATABASE IF NOT EXISTS dream_job_db;

USE dream_job_db;

CREATE TABLE IF NOT EXISTS job_applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    education VARCHAR(150) NOT NULL,
    design_tools VARCHAR(255) NOT NULL,
    design_skills TEXT NOT NULL,
    portfolio_link VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);