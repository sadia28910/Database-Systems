CREATE DATABASE IF NOT EXISTS canteen_db;
USE canteen_db;

CREATE TABLE food_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price INT
);

CREATE TABLE purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_id INT,
    qty INT,
    total_price INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO food_items (name, price) VALUES ('Burger', 120), ('Pizza', 250), ('Sandwich', 80);
