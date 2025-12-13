<?php
$stats = [
    ['title' => 'Jumlah Karyawan', 'count' => 3, 'date' => '20 November 2025'],
    ['title' => 'Total Booking', 'count' => 15, 'date' => '20 November 2025'],
    ['title' => 'Total Transaksi', 'count' => 20, 'date' => '20 November 2025']
];

$labels_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$data_transaksi = [20, 18, 28, 15, 40, 36, 26, 15, 40, 25, 28, 30];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Wash Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">

</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder">
                <i class="fa-solid fa-jug-detergent"></i><br>
                <span><img src="../img/superwash_logo.png" alt=""></span>
            </div>
        </div>
        
        <?php
        $page = basename($_SERVER['PHP_SELF']);
        ?>

        <nav class="menu">
            <a href="index.php" class="<?= ($page == 'index.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Beranda
            </a>
            <a href="karyawan.php" class="<?= ($page == 'karyawan.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Karyawan
            </a>
            <a href="transaksi.php" class="<?= ($page == 'transaksi.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-wallet"></i> Transaksi
            </a>
            <a href="pesanan.php" class="<?= ($page == 'pesanan.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-cart-shopping"></i> Pesanan
            </a>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="top-bar">
            <div class="left-nav">
                <button id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
            </div>
            <h2 class="page-title">Beranda Owner</h2>
        </header>

        <section class="hero">
            <div class="hero-content">
                <div class="hero-image">
                   <img src="../img/mesincuci.png" alt="Laundry Machine">
                </div>
                <div class="hero-text">
                    <h1>Percayakan<br>Cucianmu pada<br>Ahlinya <i></i></h1>
                </div>
            </div>
        </section>

        <section class="status-section">
            <h3>Informasi Layanan</h3>
            <div class="cards-container">
                <?php foreach($stats as $stat): ?>
                <div class="card">
                    <small><?= $stat['title'] ?></small>
                    <span class="date"><?= $stat['date'] ?></span>
                    <div class="count"><?= $stat['count'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <h3 id="judultable">Grafik Jumlah Transaksi Per Bulan</h3>
        <section class="table-section" id="grafik">
            
            <div style="position: relative; height:400px; width:100%; padding: 20px;">
                <canvas id="myBarChart"></canvas>
            </div>
        </section>

        <footer class="footer">
            <p><i class="fa-solid fa-save"></i> Kelompok 4 2025</p>
        </footer>

    </main>
</div>

<script>
    const dataGrafik = {
        labels: <?php echo json_encode($labels_bulan); ?>,
        values: <?php echo json_encode($data_transaksi); ?>
    };
</script>

<script src="../js/skrip.js?t=<?php echo time(); ?>"></script>
</body>
</html>
