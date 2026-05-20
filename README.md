# Penjualan App

Sistem Informasi Penjualan Modern Berbasis Web menggunakan:

- PHP Native
- MySQL
- Bootstrap 5
- JavaScript
- Chart.js
- SweetAlert2

---

# FITUR

## Authentication
- Login
- Register
- Logout
- Forgot Password
- Remember Me
- Session Login

## Dashboard Admin
- Statistik Penjualan
- Grafik Penjualan
- Produk Terlaris
- Notifikasi

## Produk
- CRUD Produk
- Upload Gambar
- Kategori
- Diskon
- Stock Management

## Transaksi
- Checkout
- Invoice
- QRIS
- Transfer Bank
- COD

## Laporan
- Export PDF
- Export Excel
- Print Laporan

---

# INSTALLATION

## 1. Clone Project

```bash
git clone https://github.com/username/penjualan-app.git
```

## 2. Pindahkan ke htdocs

```bash
xampp/htdocs/penjualan-app
```

## 3. Import Database

Import file:

```bash
database/penjualan_app.sql
```

## 4. Setup Database

Edit file:

```bash
config/database.php
```

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "penjualan_app";
```

## 5. Jalankan Project

```bash
http://localhost/penjualan-app
```

---

# ROLE LOGIN

## Admin
- Kelola seluruh sistem

## Cashier
- Kasir transaksi

## User
- Customer pembeli

---

# SECURITY

- Password Hashing
- CSRF Protection
- SQL Injection Protection
- Session Security
- Input Validation

---

# DEFAULT LOGIN

## Admin Login

Email:
```bash
admin@gmail.com
```

Password:
```bash
admin123
```

---

## Cashier Login

Email:
```bash
cashier@gmail.com
```

Password:
```bash
cashier123
```

---

## User Login

Email:
```bash
user@gmail.com
```

Password:
```bash
user123
```

---

# CATATAN

Pastikan data user default sudah di-import dari:

```bash
database/seed.sql
```

atau tambahkan manual ke tabel users.

# AUTHOR

Nicholas Widjaja