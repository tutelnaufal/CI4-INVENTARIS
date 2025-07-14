-- 1. Buat database terlebih dahulu
CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

-- 2. Buat tabel 'items' untuk menyimpan data inventaris
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    price INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
