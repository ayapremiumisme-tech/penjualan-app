// ======================================
// REALTIME SEARCH
// ======================================

function realtimeSearch(inputId, targetClass) {
  const input = document.getElementById(inputId);

  input.addEventListener("keyup", function () {
    let keyword = this.value.toLowerCase();

    let items = document.querySelectorAll(targetClass);

    items.forEach((item) => {
      if (item.innerText.toLowerCase().includes(keyword)) {
        item.style.display = "";
      } else {
        item.style.display = "none";
      }
    });
  });
}
