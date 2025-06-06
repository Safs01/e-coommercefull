
CREATE DATABASE IF NOT EXISTS ecommerce_sa;
USE ecommerce_sa;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'seller', 'buyer') NOT NULL
);

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT,
    name VARCHAR(100),
    description TEXT,
    price DECIMAL(10,2),
    image VARCHAR(255),
    FOREIGN KEY (seller_id) REFERENCES users(user_id)
);

INSERT INTO users (name, email, password, role) VALUES
('Admin One', 'admin@example.com', '$2y$10$WzvW6RVQk6F/...', 'admin'),
('Seller One', 'seller1@example.com', '$2y$10$WzvW6RVQk6F/...', 'seller'),
('Buyer One', 'buyer1@example.com', '$2y$10$WzvW6RVQk6F/...', 'buyer');

INSERT INTO products (seller_id, name, description, price, image) VALUES
(2, 'Handmade Beads', 'Colorful beads made from recycled glass.', 50.00, 'beads.jpg'),
(2, 'Traditional Hat', 'Zulu inspired hat for cultural events.', 120.00, 'hat.jpg'),
(2, 'Home-Made Soap', 'Organic aloe vera soap for skincare.', 30.00, 'soap.jpg');
-- Additional dummy products
INSERT INTO products (seller_id, name, description, price, image) VALUES
(2, 'African Print Dress', 'Beautiful handmade African print dress.', 250.00, 'dress.jpg'),
(2, 'Beaded Necklace', 'Handcrafted beaded necklace.', 80.00, 'necklace.jpg'),
(3, 'Ceramic Vase', 'Elegant hand-painted ceramic vase.', 120.00, 'vase.jpg'),
(2, 'Organic Honey', 'Raw honey from local farms.', 60.00, 'honey.jpg'),
(3, 'Woven Basket', 'Durable and colorful woven basket.', 90.00, 'basket.jpg'),
(2, 'Leather Sandals', 'Comfortable sandals made from genuine leather.', 180.00, 'sandals.jpg'),
(2, 'Kente Cloth', 'Traditional Ghanaian woven cloth.', 300.00, 'kente.jpg'),
(3, 'Hand-Carved Mask', 'Decorative tribal mask.', 150.00, 'mask.jpg'),
(2, 'Tie-Dye Shirt', 'Stylish tie-dye shirt.', 100.00, 'shirt.jpg'),
(3, 'Bamboo Tray', 'Eco-friendly kitchen tray.', 70.00, 'tray.jpg'),
(2, 'Essential Oils', 'Natural oils for wellness.', 110.00, 'oils.jpg'),
(3, 'Macrame Wall Art', 'Decorative wall hanging.', 130.00, 'macrame.jpg'),
(2, 'Felt Slippers', 'Warm handcrafted felt slippers.', 95.00, 'slippers.jpg'),
(3, 'Wooden Toy Car', 'Safe toy car made of wood.', 85.00, 'toycar.jpg'),
(2, 'Printed Tote Bag', 'Reusable tote with African patterns.', 60.00, 'totebag.jpg'),
(3, 'Recycled Paper Journal', 'Eco-friendly handmade journal.', 40.00, 'journal.jpg'),
(2, 'Crochet Hat', 'Colorful winter hat.', 55.00, 'crochet.jpg'),
(3, 'Clay Cooking Pot', 'Traditional clay pot for cooking.', 220.00, 'claypot.jpg'),
(2, 'Hand-Painted Mug', 'Ceramic mug with tribal design.', 50.00, 'mug.jpg'),
(3, 'Braided Belt', 'Leather belt with braided design.', 135.00, 'belt.jpg');

