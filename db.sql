CREATE DATABASE amazonduo;
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