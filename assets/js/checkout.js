// ======================================
// CHECKOUT JS
// ======================================

function calculateTotal(price, qty, tax = 0) {
  let subtotal = price * qty;

  let totalTax = (subtotal * tax) / 100;

  return subtotal + totalTax;
}
