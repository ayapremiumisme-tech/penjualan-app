CREATE DATABASE IF NOT EXISTS penjualan_app;
USE penjualan_app;

-- =====================================
-- TABLE USERS
-- =====================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    photo VARCHAR(255),
    role ENUM('admin','cashier','user') DEFAULT 'user',
    status ENUM('active','inactive') DEFAULT 'active',
    remember_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================
-- TABLE CATEGORIES
-- =====================================

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================
-- TABLE PRODUCTS
-- =====================================

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) UNIQUE,
    description TEXT,
    price DECIMAL(12,2) DEFAULT 0,
    discount DECIMAL(12,2) DEFAULT 0,
    stock INT DEFAULT 0,
    image VARCHAR(255),
    status ENUM('available','out_stock') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (category_id) REFERENCES categories(id)
    ON DELETE SET NULL
);

-- =====================================
-- TABLE PRODUCT IMAGES
-- =====================================

CREATE TABLE product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    image VARCHAR(255),

    FOREIGN KEY (product_id) REFERENCES products(id)
    ON DELETE CASCADE
);

-- =====================================
-- TABLE CARTS
-- =====================================

CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    qty INT DEFAULT 1,
    subtotal DECIMAL(12,2) DEFAULT 0,

    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (product_id) REFERENCES products(id)
    ON DELETE CASCADE
);

-- =====================================
-- TABLE WISHLIST
-- =====================================

CREATE TABLE wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,

    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (product_id) REFERENCES products(id)
    ON DELETE CASCADE
);

-- =====================================
-- TABLE TRANSACTIONS
-- =====================================

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_number VARCHAR(100) UNIQUE,
    user_id INT,
    total_price DECIMAL(12,2),
    tax DECIMAL(12,2),
    discount DECIMAL(12,2),
    grand_total DECIMAL(12,2),
    payment_method VARCHAR(50),
    payment_status ENUM('pending','paid','failed') DEFAULT 'pending',
    order_status ENUM('pending','process','done','cancel') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
);

-- =====================================
-- TABLE TRANSACTION DETAILS
-- =====================================

CREATE TABLE transaction_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT,
    product_id INT,
    price DECIMAL(12,2),
    qty INT,
    subtotal DECIMAL(12,2),

    FOREIGN KEY (transaction_id) REFERENCES transactions(id)
    ON DELETE CASCADE,

    FOREIGN KEY (product_id) REFERENCES products(id)
    ON DELETE CASCADE
);

-- =====================================
-- TABLE PAYMENTS
-- =====================================

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT,
    payment_method VARCHAR(50),
    payment_proof VARCHAR(255),
    status ENUM('pending','paid','failed') DEFAULT 'pending',
    paid_at TIMESTAMP NULL,

    FOREIGN KEY (transaction_id) REFERENCES transactions(id)
    ON DELETE CASCADE
);

-- =====================================
-- TABLE ACTIVITY LOGS
-- =====================================

CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    activity TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
);

-- =====================================
-- TABLE BANNERS
-- =====================================

CREATE TABLE banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    image VARCHAR(255),
    link VARCHAR(255),
    status ENUM('active','inactive') DEFAULT 'active'
);

-- =====================================
-- TABLE TESTIMONIALS
-- =====================================

CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT,
    rating INT DEFAULT 5,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',

    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
);