CREATE DATABASE sisho;
USE sisho;

-- Tabla de usuarios (solo admin)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin') DEFAULT 'admin'
);

-- Insertar admin por defecto (password: admin123)
INSERT INTO users (username, password) 
VALUES ('admin', SHA2('admin123', 256));

-- Tabla de hoteles
CREATE TABLE hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
