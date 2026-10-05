CREATE DATABASE IF NOT EXISTS amazonduo;
USE amazonduo;

-- =========================
-- TABLA USERS
-- =========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- =========================
-- TABLA CARTS
-- =========================
CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,

    CONSTRAINT fk_carts_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =========================
-- TABLA PRODUCTS
-- =========================
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,

    CONSTRAINT chk_product_price
        CHECK (price >= 0),

    CONSTRAINT chk_product_stock
        CHECK (stock >= 0)
);

-- =========================
-- RELACIÓN CARTS-PRODUCTS
-- =========================
CREATE TABLE cart_products (
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,

    PRIMARY KEY (cart_id, product_id),

    CONSTRAINT fk_cart_products_cart
        FOREIGN KEY (cart_id)
        REFERENCES carts(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_cart_products_product
        FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT chk_cart_products_quantity
        CHECK (quantity > 0)
);

-- =========================
-- DATOS DE PRUEBA
-- =========================

-- Usuarios (contraseña: 1234 para todos)
INSERT INTO users (username, password) VALUES
('javier', '81dc9bdb52d04dc20036dbd8313ed055'),
('alejandro', '81dc9bdb52d04dc20036dbd8313ed055'),
('nerea', '81dc9bdb52d04dc20036dbd8313ed055');

-- Productos
INSERT INTO products (name, price, stock) VALUES
('Portatil HP Pavilion 15', 649.99, 25),
('Raton Logitech MX Master 3', 89.99, 50),
('Teclado Mecanico Corsair K70', 129.99, 30),
('Monitor Samsung 27" 4K', 349.99, 15),
('Auriculares Sony WH-1000XM5', 299.99, 40),
('Webcam Logitech C920', 69.99, 60),
('Disco SSD Samsung 1TB', 109.99, 35),
('Tablet Samsung Galaxy Tab S9', 449.99, 20),
('Cargador USB-C 65W', 29.99, 100),
('Mochila para Portatil', 39.99, 45);

-- Carritos
INSERT INTO carts (date, user_id) VALUES
('2026-10-01 10:30:00', 1),
('2026-10-02 14:15:00', 2),
('2026-10-03 09:45:00', 1),
('2026-10-04 18:00:00', 3);

-- Productos en carritos
INSERT INTO cart_products (cart_id, product_id, quantity) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 9, 1),
(2, 5, 1),
(2, 3, 1),
(3, 4, 1),
(3, 7, 2),
(4, 8, 1),
(4, 6, 1),
(4, 10, 3);
