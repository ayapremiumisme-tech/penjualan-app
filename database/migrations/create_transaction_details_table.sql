CREATE TABLE transaction_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT,
    product_id INT,
    price DECIMAL(12,2),
    qty INT,
    subtotal DECIMAL(12,2)
);