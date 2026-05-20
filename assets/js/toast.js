// ======================================
// TOAST NOTIFICATION
// ======================================

function showToast(icon, title) {
  Swal.fire({
    toast: true,
    position: "top-end",
    icon: icon,
    title: title,
    showConfirmButton: false,
    timer: 3000,
  });
}
