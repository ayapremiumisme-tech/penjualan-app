// ======================================
// CART JS
// ======================================

function increaseQty(inputId) {
  let input = document.getElementById(inputId);

  input.value = parseInt(input.value) + 1;
}

function decreaseQty(inputId) {
  let input = document.getElementById(inputId);

  if (input.value > 1) {
    input.value = parseInt(input.value) - 1;
  }
}
