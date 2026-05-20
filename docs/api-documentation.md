# API DOCUMENTATION

Base URL:

```txt
http://localhost/penjualan-app/api/
```

---

# AUTH API

## Login

Endpoint:

```txt
POST /auth/login.php
```

Parameter:

```json
{
  "email": "admin@gmail.com",
  "password": "admin123"
}
```

Response:

```json
{
  "status": true,
  "message": "Login berhasil"
}
```

---

## Register

Endpoint:

```txt
POST /auth/register.php
```

---

# PRODUCT API

## Get Products

Endpoint:

```txt
GET /products/get-products.php
```

---

## Get Product Detail

Endpoint:

```txt
GET /products/get-product.php?id=1
```

---

## Search Product

Endpoint:

```txt
GET /products/search.php?keyword=laptop
```

---

# CART API

## Add Cart

Endpoint:

```txt
POST /cart/add.php
```

Parameter:

```json
{
  "product_id": 1,
  "qty": 1
}
```

---

## Update Cart

Endpoint:

```txt
POST /cart/update.php
```

---

## Delete Cart

Endpoint:

```txt
POST /cart/delete.php
```

---

# CHECKOUT API

## Process Checkout

Endpoint:

```txt
POST /checkout/process.php
```

---

## Payment

Endpoint:

```txt
POST /checkout/payment.php
```

---

# DASHBOARD API

## Stats

Endpoint:

```txt
GET /dashboard/stats.php
```

---

## Charts

Endpoint:

```txt
GET /dashboard/charts.php
```