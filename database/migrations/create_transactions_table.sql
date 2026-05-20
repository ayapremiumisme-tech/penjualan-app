CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_number VARCHAR(100),
    user_id INT,
    total_price DECIMAL(12,2),
    tax DECIMAL(12,2),
    discount DECIMAL(12,2),
    grand_total DECIMAL(12,2),
    payment_method VARCHAR(50),
    payment_status ENUM('pending','paid','failed') DEFAULT 'pending',
    order_status ENUM('pending','process','done','cancel') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);