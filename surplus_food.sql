DROP DATABASE IF EXISTS surplus_food;
CREATE DATABASE surplus_food;
USE surplus_food;

CREATE TABLE restaurant_owners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
	address VARCHAR(255) NOT NULL
);

INSERT INTO restaurant_owners (restaurant_name, username, password, address)
VALUES
    ('Chipotle', 'user1', 'password1', '2230 Guadalupe St, Austin, TX 78705'),
    ('Pizza Hut', 'user2', 'password2', 'University Market, 711 W 23rd St, Austin, TX 78705'),
    ('Cava', 'user3', 'password3', '2426 Guadalupe St, Austin, TX 78705'),
    ('Roppolo"s Pizzeria', 'user4', 'password4', '2604 Guadalupe St Ste A, Austin, TX 78705'),
    ('Kerbey Lane Cafe', 'user5', 'password5', '2606 Guadalupe St, Austin, TX 78705');
    
CREATE TABLE food_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_name VARCHAR(255) NOT NULL,
    food_type VARCHAR(255) NOT NULL,
    amount INT, -- in servings
    restaurant_owner_id INT,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (restaurant_owner_id) REFERENCES restaurant_owners(id)
);

INSERT INTO food_entries (restaurant_name, food_type, amount, restaurant_owner_id)
VALUES
    ('Chipotle', 'Steak burrito', '10', 1),
    ('Pizza Hut', 'Cheese pizza', '5', 2),
    ('Cava', 'Salad Bowls', '15', 3),
    ('Kerbey Lane Cafe', 'Mac and cheese', '4', 5),
    ('Roppolo"s Pizzeria', 'Spaghetti and meatballs', '8', 4),
    ('Pizza Hut', 'Pepperoni pizza', '3', 2),
    ('Chipotle', 'Burrito bowl', '4', 1),
    ('Pizza Hut', 'Veggie pizza', '5', 2),
    ('Cava', 'Rice Bowl', '15', 3),
    ('Roppolo"s Pizzeria', 'Spaghetti and meatballs', '8', 4),
    ('Pizza Hut', 'Chicken pizza', '3', 2),
    ('Kerbey Lane Cafe', 'Burger', '13', 5),
    ('Chipotle', 'Barbacoa burrito', '6', 1),
    ('Roppolo"s Pizzeria', 'Lasagna', '10', 4),
    ('Cava', 'Grilled chicken bowl', '12', 3),
    ('Chipotle', 'Carnitas burrito', '8', 1),
    ('Kerbey Lane Cafe', 'Salad', '2', 5),
    ('Pizza Hut', 'Veggie pizza', '6', 2),
    ('Roppolo"s Pizzeria', 'Chicken Alfredo', '7', 4),
    ('Cava', 'Falafel bowl', '10', 3);

SELECT * FROM food_entries;
SELECT * FROM restaurant_owners;