# DATABASE DESIGN

Database Name:

```txt
penjualan_app
```

---

# TABLE LIST

## users

| Field | Type |
|---|---|
| id | bigint |
| name | varchar |
| email | varchar |
| password | text |
| role | enum |
| status | enum |
| photo | varchar |

---

## products

| Field | Type |
|---|---|
| id | bigint |
| category_id | bigint |
| name | varchar |
| slug | varchar |
| price | decimal |
| stock | int |
| image | varchar |

---

## categories

| Field | Type |
|---|---|
| id | bigint |
| name | varchar |
| slug | varchar |

---

## transactions

| Field | Type |
|---|---|
| id | bigint |
| invoice_number | varchar |
| user_id | bigint |
| total | decimal |
| tax | decimal |
| grand_total | decimal |
| payment_status | enum |

---

## transaction_details

| Field | Type |
|---|---|
| id | bigint |
| transaction_id | bigint |
| product_id | bigint |
| qty | int |
| subtotal | decimal |

---

## payments

| Field | Type |
|---|---|
| id | bigint |
| transaction_id | bigint |
| payment_method | varchar |
| payment_status | enum |

---

## carts

| Field | Type |
|---|---|
| id | bigint |
| user_id | bigint |
| product_id | bigint |
| qty | int |

---

## wishlist

| Field | Type |
|---|---|
| id | bigint |
| user_id | bigint |
| product_id | bigint |

---

## activity_logs

| Field | Type |
|---|---|
| id | bigint |
| user_id | bigint |
| activity | text |

---

## banners

| Field | Type |
|---|---|
| id | bigint |
| title | varchar |
| image | varchar |

---

## testimonials

| Field | Type |
|---|---|
| id | bigint |
| user_id | bigint |
| message | text |
| status | enum |