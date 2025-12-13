document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");

  toggleBtn.addEventListener("click", function () {
    if (window.innerWidth <= 768) {
      sidebar.classList.toggle("active");
    } else {
      sidebar.classList.toggle("hidden");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const chartCanvas = document.getElementById("myBarChart");

  if (chartCanvas) {
    const ctx = chartCanvas.getContext("2d");

    const myBarChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: dataGrafik.labels, // ambil dari jembatan
        datasets: [
          {
            label: "Jumlah Transaksi",
            data: dataGrafik.values, // ambil dari jembatan
            backgroundColor: "#fd7e14",
            borderColor: "#e67e22",
            borderWidth: 1,
            borderRadius: 5,
            barPercentage: 0.7,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              font: {
                family: "'Poppins', sans-serif",
                size: 14,
              },
            },
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: "#f0f0f0" },
          },
          x: {
            grid: { display: false },
          },
        },
      },
    });
  }
});
