document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");

  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener("click", function (e) {
      e.preventDefault();
      if (window.innerWidth <= 768) {
        sidebar.classList.toggle("active");
        sidebar.classList.remove("hidden");
      } else {
        sidebar.classList.toggle("hidden");
        sidebar.classList.remove("active");
      }
    });
  }

  const chartCanvas = document.getElementById("myBarChart");

  if (
    chartCanvas &&
    typeof Chart !== "undefined" &&
    typeof dataGrafik !== "undefined"
  ) {
    const ctx = chartCanvas.getContext("2d");
    new Chart(ctx, {
      type: "bar",
      data: {
        labels: dataGrafik.labels,
        datasets: [
          {
            label: "Jumlah Transaksi",
            data: dataGrafik.values,
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
          legend: { position: "bottom" },
        },
        scales: {
          y: { beginAtZero: true },
          x: { grid: { display: false } },
        },
      },
    });
  }

  const profileTrigger = document.getElementById("profileTrigger");
  const dropdownMenu = document.getElementById("dropdownMenu");

  if (profileTrigger && dropdownMenu) {
    profileTrigger.addEventListener("click", function (e) {
      e.stopPropagation();
      dropdownMenu.classList.toggle("active");
    });

    document.addEventListener("click", function (e) {
      if (
        !dropdownMenu.contains(e.target) &&
        !profileTrigger.contains(e.target)
      ) {
        dropdownMenu.classList.remove("active");
      }
    });
  }
});
