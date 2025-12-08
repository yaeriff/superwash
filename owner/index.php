<?php
$stats = [
    ['title' => 'Pesanan Diterima', 'count' => 20, 'date' => '20 November 2025'],
    ['title' => 'Pesanan Diproses', 'count' => 30, 'date' => '20 November 2025'],
    ['title' => 'Pesanan Siap Diambil', 'count' => 12, 'date' => '20 November 2025']
];

$paketKilo = [
    ['code' => 'PK001', 'name' => 'Cuci Paket', 'price' => 6000, 'est' => 3, 'type' => 'Reguler'],
    ['code' => 'PK002', 'name' => 'Cuci Kering', 'price' => 4500, 'est' => 3, 'type' => 'Reguler'],
    ['code' => 'PK003', 'name' => 'Cuci Basah', 'price' => 4500, 'est' => 3, 'type' => 'Reguler'],
    ['code' => 'PK004', 'name' => 'Paket Cuci', 'price' => 4500, 'est' => 3, 'type' => 'Reguler'],
    ['code' => 'PK005', 'name' => 'Paket Cuci', 'price' => 6000, 'est' => 3, 'type' => 'Reguler'],
];

$paketSatuan = [
    ['code' => 'ST001', 'name' => 'Boneka', 'price' => 10000, 'est' => 3, 'type' => 'Reguler'],
    ['code' => 'ST002', 'name' => 'Helm', 'price' => 15000, 'est' => 3, 'type' => 'Reguler'],
    ['code' => 'ST003', 'name' => 'Tas', 'price' => 15000, 'est' => 3, 'type' => 'Reguler'],
    ['code' => 'ST004', 'name' => 'Sepatu', 'price' => 15000, 'est' => 3, 'type' => 'Reguler'],
];
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
    <link rel="stylesheet" href="css/style.css?t=<?php echo time(); ?>">

</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder">
                <i class="fa-solid fa-jug-detergent"></i><br>
                <span><img src="img/superwash_logo.png" alt=""></span>
            </div>
        </div>
        
        <?php
        $page = basename($_SERVER['PHP_SELF']);
        ?>

        <nav class="menu">
            <a href="index.php" class="<?= ($page == 'index.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Beranda
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
            <h2 class="page-title">Beranda Karyawan</h2>
            <div class="auth-buttons">
                <a href="login.php">
                    <button class="btn-login">Masuk</button>
                </a>
                <a href="register.php">
                    <button class="btn-register">Daftar</button>
                </a>
            </div>
        </header>

        <section class="hero">
            <div class="hero-content">
                <div class="hero-image">
                   <img src="img/mesincuci.png" alt="Laundry Machine">
                </div>
                <div class="hero-text">
                    <h1>Percayakan<br>Cucianmu pada<br>Ahlinya <i></i></h1>
                </div>
            </div>
        </section>

        <section class="status-section">
            <h3>Status Pesanan</h3>
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

        <section class="table-section">
            <h3>List Paket PerKilo</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Paket</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Estimasi</th>
                            <th>Jenis Cuci</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($paketKilo as $row): ?>
                        <tr>
                            <td><?= $row['code'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= number_format($row['price'], 0, ',', '.') ?></td>
                            <td><?= $row['est'] ?> Hari</td>
                            <td><?= $row['type'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="table-section">
            <h3>List Paket Satuan</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Paket</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Estimasi</th>
                            <th>Jenis Cuci</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($paketSatuan as $row): ?>
                        <tr>
                            <td><?= $row['code'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td>Rp <?= number_format($row['price'], 0, ',', '.') ?></td>
                            <td><?= $row['est'] ?> Hari</td>
                            <td><?= $row['type'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="footer">
            <p><i class="fa-solid fa-save"></i> Kelompok 4 2025</p>
        </footer>

    </main>
</div>

<script src="js/skrip.js"></script>
</body>
</html>
