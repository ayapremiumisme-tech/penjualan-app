// ======================================
// CHART CONFIG
// ======================================

function salesChart(canvasId, labels, data) {
  const ctx = document.getElementById(canvasId);

  new Chart(ctx, {
    type: "bar",

    data: {
      labels: labels,
      datasets: [
        {
          label: "Penjualan",
          data: data,
          borderWidth: 1,
        },
      ],
    },

    options: {
      responsive: true,
    },
  });
}
