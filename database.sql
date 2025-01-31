-- Create Database
CREATE DATABASE ecommerce;

-- Use Database
USE ecommerce;

-- Create Table
CREATE TABLE computers (
    ComputerID INT AUTO_INCREMENT PRIMARY KEY,
    ComputerName VARCHAR(255) NOT NULL,
    Description TEXT NOT NULL,
    Quantity INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    ProductAddedBy VARCHAR(255) DEFAULT 'Kishan Kumar Das' NOT NULL
);
