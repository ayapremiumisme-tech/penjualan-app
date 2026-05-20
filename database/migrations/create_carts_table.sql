CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    qty INT,
    subtotal DECIMAL(12,2)
);