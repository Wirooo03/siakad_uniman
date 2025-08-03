-- MySQL Database Setup for SIAKAD UNIMAN
-- Run this in MySQL Command Line or phpMyAdmin

-- Create database
CREATE DATABASE IF NOT EXISTS siakad_uniman 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Use the database
USE siakad_uniman;

-- Show created database
SHOW DATABASES LIKE 'siakad_uniman';

-- Grant privileges (if needed for specific user)
-- GRANT ALL PRIVILEGES ON siakad_uniman.* TO 'root'@'localhost';
-- FLUSH PRIVILEGES;

-- Show status
SELECT 'Database siakad_uniman created successfully!' as Status;
