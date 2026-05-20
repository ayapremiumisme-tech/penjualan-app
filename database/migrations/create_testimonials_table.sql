CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT,
    rating INT DEFAULT 5,
    status ENUM('pending','approved','rejected') DEFAULT 'pending'
);