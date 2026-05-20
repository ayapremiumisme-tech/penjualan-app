// ======================================
// FORM VALIDATION
// ======================================

function validateRequired(inputId, message) {
  let input = document.getElementById(inputId);

  if (input.value.trim() === "") {
    alert(message);
    input.focus();

    return false;
  }

  return true;
}
