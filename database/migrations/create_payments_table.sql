CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT,
    payment_method VARCHAR(50),
    payment_proof VARCHAR(255),
    status ENUM('pending','paid','failed') DEFAULT 'pending',
    paid_at TIMESTAMP NULL
);