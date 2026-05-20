// ======================================
// SWEET ALERT
// ======================================

function deleteConfirm(url) {
  Swal.fire({
    title: "Yakin?",
    text: "Data akan dihapus!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = url;
    }
  });
}
