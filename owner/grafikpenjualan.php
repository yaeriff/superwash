<?php
include '../koneksi.php';
$querySummary = mysqli_query($koneksi, "
    SELECT 
        SUM(total_bayar) as total_omset,
        COUNT(*) as total_transaksi,
        AVG(total_bayar) as rata_rata
    FROM transaksi
");
$dataSummary = mysqli_fetch_assoc($querySummary);

function formatRupiah($angka){
    return "Rp " . number_format($angka, 0, ',', '.');
}

$tglSekarang = date('d F Y');

$queryGrafik1 = mysqli_query($koneksi, "
    SELECT tanggal, SUM(total_bayar) as omset 
    FROM transaksi 
    GROUP BY tanggal 
    ORDER BY tanggal ASC
");

$label_tgl = [];
$data_omset = [];

while($row = mysqli_fetch_assoc($queryGrafik1)) {
    $label_tgl[] = date('d/m/Y', strtotime($row['tanggal'])); 
    $data_omset[] = $row['omset'];
}

$queryGrafik2 = mysqli_query($koneksi, "
    SELECT tanggal, COUNT(*) as jumlah 
    FROM transaksi 
    GROUP BY tanggal 
    ORDER BY tanggal ASC
");

$data_jumlah = [];
while($row = mysqli_fetch_assoc($queryGrafik2)) {
    $data_jumlah[] = $row['jumlah'];
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Penjualan - Super Wash</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">

    <style>
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            border: 2px solid #e67e22;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .summary-card h4 {
            font-size: 16px;
            color: #000;
            margin-bottom: 5px;
        }

        .summary-card .date-label {
            font-size: 12px;
            color: #888;
            margin-bottom: 15px;
            display: block;
        }

        .summary-card .value {
            font-size: 28px;
            font-weight: 700;
            color: #e67e22;
        }

        .chart-container-box {
            background: white;
            border: 2px solid #e67e22;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            position: relative;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h3 {
            margin: 0;
            font-size: 18px;
            color: #000;
        }

        .btn-kembali-chart {
            background-color: #fd7e14;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .btn-kembali-chart:hover {
            background-color: #e67e22;
            color: white;
        }

        /* Area Canvas Grafik */
        .chart-area {
            height: 350px; /* Tinggi grafik */
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder">
                <span><img src="../img/superwash_logo.png" alt=""></span>
            </div>
        </div>
        <nav class="menu">
            <a href="index.php"><i class="fa-solid fa-house"></i> Beranda</a>
            <a href="karyawan.php"><i class="fa-solid fa-users"></i> Karyawan</a>
            <a href="transaksi.php" class="active"><i class="fa-solid fa-wallet"></i> Transaksi</a> <a href="pesanan.php"><i class="fa-solid fa-cart-shopping"></i> Pesanan</a>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="top-bar">
            <div class="left-nav">
                <button id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
            </div>
            <h2 class="page-title">Grafik Transaksi</h2>
        </header>

        <section class="table-section" style="background: transparent; border: none; box-shadow: none; padding: 20px;">
            
            <div class="cards-grid">
                <div class="summary-card">
                    <h4>Total Penjualan</h4>
                    <span class="date-label"><?= $tglSekarang ?></span>
                    <div class="value"><?= formatRupiah($dataSummary['total_omset']) ?></div>
                </div>

                <div class="summary-card">
                    <h4>Total Transaksi</h4>
                    <span class="date-label"><?= $tglSekarang ?></span>
                    <div class="value"><?= $dataSummary['total_transaksi'] ?></div>
                </div>

                <div class="summary-card">
                    <h4>Rata-rata per Transaksi</h4>
                    <span class="date-label"><?= $tglSekarang ?></span>
                    <div class="value"><?= formatRupiah($dataSummary['rata_rata']) ?></div>
                </div>
            </div>

            <div class="chart-container-box">
                <div class="chart-header">
                    <h3>Trend Penjualan Harian</h3>
                    <a href="transaksi.php" class="btn-kembali-chart">
                        <i class="fa-solid fa-list"></i> Kembali ke List Transaksi
                    </a>
                </div>
                <div class="chart-area">
                    <canvas id="chartPenjualan"></canvas>
                </div>
            </div>

            <div class="chart-container-box">
                <div class="chart-header">
                    <h3>Jumlah Transaksi Harian</h3>
                    <a href="transaksi.php" class="btn-kembali-chart">
                        <i class="fa-solid fa-list"></i> Kembali ke List Transaksi
                    </a>
                </div>
                <div class="chart-area">
                    <canvas id="chartJumlah"></canvas>
                </div>
            </div>

        </section>

        <footer class="footer">
            <p><i class="fa-solid fa-save"></i> Kelompok 4 2025</p>
        </footer>

    </main>
</div>

<script src="../js/skrip.js"></script>
<script>
    // --- GRAFIK 1: TREND PENJUALAN (Omset) ---
    const ctx1 = document.getElementById('chartPenjualan').getContext('2d');
    
    // Bikin Gradient Ungu (Agar mirip desain)
    const gradientUngu = ctx1.createLinearGradient(0, 0, 0, 400);
    gradientUngu.addColorStop(0, 'rgba(138, 43, 226, 0.5)'); // Ungu atas
    gradientUngu.addColorStop(1, 'rgba(138, 43, 226, 0.0)'); // Transparan bawah

    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: <?= json_encode($label_tgl) ?>, // Ambil dari PHP
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: <?= json_encode($data_omset) ?>, // Ambil dari PHP
                borderColor: '#8e44ad', // Warna Garis Ungu
                backgroundColor: gradientUngu, // Warna Isi Bawah
                borderWidth: 2,
                tension: 0.4, // Membuat garis melengkung (smooth)
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#8e44ad',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f0f0f0', borderDash: [5, 5] }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // --- GRAFIK 2: JUMLAH TRANSAKSI (Qty) ---
    const ctx2 = document.getElementById('chartJumlah').getContext('2d');

    // Bikin Gradient Hijau/Teal
    const gradientHijau = ctx2.createLinearGradient(0, 0, 0, 400);
    gradientHijau.addColorStop(0, 'rgba(46, 204, 113, 0.5)');
    gradientHijau.addColorStop(1, 'rgba(46, 204, 113, 0.0)');

    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: <?= json_encode($label_tgl) ?>,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: <?= json_encode($data_jumlah) ?>,
                borderColor: '#2ecc71',
                backgroundColor: gradientHijau,
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#2ecc71',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: '#f0f0f0', borderDash: [5, 5] }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>

</body>
</html>