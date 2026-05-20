# INSTALLATION GUIDE

## Sistem Requirements

- PHP 8.0+
- MySQL 5.7+
- Apache/Nginx
- XAMPP/Laragon
- Browser Modern

---

# Cara Install

## 1. Copy Project

Pindahkan folder:

```bash
penjualan-app
```

ke:

```bash
htdocs/
```

jika menggunakan XAMPP.

---

## 2. Import Database

Buka:

```txt
phpMyAdmin
```

buat database:

```sql
penjualan_app
```

lalu import file:

```txt
database/penjualan_app.sql
```

---

## 3. Konfigurasi Database

Edit file:

```txt
config/database.php
```

ubah:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "penjualan_app";
```

---

## 4. Jalankan Project

Buka browser:

```txt
http://localhost/penjualan-app
```

---

# Login Default

## Admin

Email:

```txt
admin@gmail.com
```

Password:

```txt
admin123
```

---

# Struktur Folder

```txt
admin/
user/
cashier/
api/
assets/
config/
database/
includes/
templates/
uploads/
storage/
```

---

# Teknologi

- PHP Native
- MySQL
- Bootstrap 5
- Chart.js
- JQuery
- SweetAlert2
- Font Awesome

---

# Troubleshooting

## Error Database

Pastikan:

- MySQL aktif
- Database sudah diimport
- Config database benar

---

## File Upload Gagal

Pastikan folder:

```txt
uploads/
```

memiliki permission:

```txt
755 / 777
```