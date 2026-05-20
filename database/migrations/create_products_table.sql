CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(150),
    slug VARCHAR(150),
    description TEXT,
    price DECIMAL(12,2),
    discount DECIMAL(12,2),
    stock INT,
    image VARCHAR(255),
    status ENUM('available','out_stock') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);