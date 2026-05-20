USE penjualan_app;

-- =====================================
-- DEFAULT USERS
-- =====================================

INSERT INTO users
(name, email, password, role, status)
VALUES

(
'Administrator',
'admin@gmail.com',
'$2y$10$4P8k7n9wM7h9uG9w8mK5YeKq2t7Q8XJ9Lz3b5t9V1s3W2Q7dT6x1G',
'admin',
'active'
),

(
'Cashier',
'cashier@gmail.com',
'$2y$10$4P8k7n9wM7h9uG9w8mK5YeKq2t7Q8XJ9Lz3b5t9V1s3W2Q7dT6x1G',
'cashier',
'active'
),

(
'Customer',
'user@gmail.com',
'$2y$10$4P8k7n9wM7h9uG9w8mK5YeKq2t7Q8XJ9Lz3b5t9V1s3W2Q7dT6x1G',
'user',
'active'
);

-- Password semua user:
-- admin123

-- =====================================
-- DEFAULT CATEGORIES
-- =====================================

INSERT INTO categories(name, slug)
VALUES
('Elektronik', 'elektronik'),
('Fashion', 'fashion'),
('Makanan', 'makanan');

-- =====================================
-- DEFAULT PRODUCTS
-- =====================================

INSERT INTO products
(category_id, name, slug, description, price, discount, stock, image)
VALUES

(
1,
'Laptop Gaming',
'laptop-gaming',
'Laptop gaming performa tinggi',
15000000,
500000,
10,
'laptop.jpg'
),

(
2,
'Kaos Premium',
'kaos-premium',
'Kaos premium kualitas terbaik',
150000,
10000,
50,
'kaos.jpg'
),

(
3,
'Snack Box',
'snack-box',
'Snack box enak dan murah',
25000,
0,
100,
'snack.jpg'
);