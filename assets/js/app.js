// ======================================
// MAIN APP JS
// ======================================

console.log("Penjualan App Loaded");

function previewImage(input, target) {
  const file = input.files[0];

  if (file) {
    const reader = new FileReader();

    reader.onload = function (e) {
      document.getElementById(target).src = e.target.result;
    };

    reader.readAsDataURL(file);
  }
}
