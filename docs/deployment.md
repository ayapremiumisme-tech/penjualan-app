# DEPLOYMENT GUIDE

# Shared Hosting

## Upload File

Compress project:

```txt
penjualan-app.zip
```

upload ke:

```txt
public_html/
```

extract file.

---

# Import Database

Buka:

```txt
cPanel > phpMyAdmin
```

Import:

```txt
database/penjualan_app.sql
```

---

# Edit Config

File:

```txt
config/config.php
```

ubah:

```php
define('APP_URL', 'https://domainanda.com');
```

---

# Permission Folder

Set folder berikut:

```txt
uploads/
storage/
```

permission:

```txt
755
```

atau:

```txt
777
```

---

# SSL HTTPS

Aktifkan SSL di hosting.

Pastikan APP_URL menggunakan:

```txt
https://
```

---

# Optimasi Production

## Disable Error

Edit:

```php
display_errors = Off
```

---

## Enable Compression

Tambahkan di `.htaccess`

```apache
<IfModule mod_deflate.c>

AddOutputFilterByType DEFLATE
text/html text/plain text/xml
text/css application/javascript

</IfModule>
```

---

# Backup Database

Lakukan backup rutin:

```txt
phpMyAdmin > Export
```

---

# Security Checklist

- Gunakan HTTPS
- Ganti password admin
- Aktifkan CSRF
- Batasi permission folder
- Backup database rutin
```