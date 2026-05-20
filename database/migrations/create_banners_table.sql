CREATE TABLE banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    image VARCHAR(255),
    link VARCHAR(255),
    status ENUM('active','inactive') DEFAULT 'active'
);