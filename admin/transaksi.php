<?php
$dataTransaksi = [
    ['kode_transaksi' => 'TR001', 'tanggal' => '2025-11-29', 'nama_pelanggan' => 'nana', 'total_harga' => 10800, 'status' => 'Selesai', 'jumlah_kg' => 1.8, 'id_karyawan' => 'K001', 'kode_booking' => 'BK0001'], // Menambahkan data baru
    ['kode_transaksi' => 'TR002', 'tanggal' => '2025-11-29', 'nama_pelanggan' => 'sani', 'total_harga' => 9000, 'status' => 'Selesai', 'jumlah_kg' => 1.5, 'id_karyawan' => 'K001', 'kode_booking' => 'BK0002'],
    ['kode_transaksi' => 'TR003', 'tanggal' => '2025-11-30', 'nama_pelanggan' => 'Budi', 'total_harga' => 15000, 'status' => 'Diproses', 'jumlah_kg' => 2.0, 'id_karyawan' => 'K002', 'kode_booking' => 'BK0003'],
    ['kode_transaksi' => 'TR004', 'tanggal' => '2025-11-30', 'nama_pelanggan' => 'Cinta', 'total_harga' => 12000, 'status' => 'Menunggu Pembayaran', 'jumlah_kg' => 3.0, 'id_karyawan' => 'K001', 'kode_booking' => 'BK0004'],
    ['kode_transaksi' => 'TR005', 'tanggal' => '2025-12-01', 'nama_pelanggan' => 'Dedy', 'total_harga' => 7200, 'status' => 'Selesai', 'jumlah_kg' => 1.2, 'id_karyawan' => 'K003', 'kode_booking' => 'BK0005'],
    ['kode_transaksi' => 'TR006', 'tanggal' => '2025-12-01', 'nama_pelanggan' => 'Eka', 'total_harga' => 17500, 'status' => 'Diproses', 'jumlah_kg' => 2.5, 'id_karyawan' => 'K002', 'kode_booking' => 'BK0006'],
    ['kode_transaksi' => 'TR007', 'tanggal' => '2025-12-02', 'nama_pelanggan' => 'Fani', 'total_harga' => 6000, 'status' => 'Selesai', 'jumlah_kg' => 1.5, 'id_karyawan' => 'K003', 'kode_booking' => 'BK0007'],
    ['kode_transaksi' => 'TR008', 'tanggal' => '2025-12-02', 'nama_pelanggan' => 'Gilang', 'total_harga' => 16500, 'status' => 'Selesai', 'jumlah_kg' => 2.2, 'id_karyawan' => 'K001', 'kode_booking' => 'BK0008'],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Wash Dashboard - Transaksi</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style2.css?t=<?php echo time(); ?>">

</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder">
                <span><img src="../img/superwash_logo.png" alt="Super Wash Logo"></span>
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
            
            <h2 class="page-title">Transaksi</h2>
            
            <div class="search-and-admin">
                <div class="auth-info">
                     <div class="admin-avatar"><i class="fa-solid fa-user"></i></div>
                     <span class="admin-name">Hi, Admin <i class="fa-solid fa-caret-down"></i></span>
                </div>
            </div>
        </header>

        <section class="transaction-data-section">
            <div class="data-table-container">
                
                <div class="data-table-header-controls">
                    <div class="length-control">
                        Tampilan 
                        <select name="data-length" id="data-length">
                            <option value="10">10</option>
                        </select> 
                        entri
                    </div>
                    
                    <div class="search-control-top">
                         Cari: <input type="text" id="table-search-input">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="pesanan-table"> 
                        <thead>
                            <tr>
                                <th>Kode Transaksi <i class="fa-solid fa-sort-up"></i></th>
                                <th>Tanggal <i class="fa-solid fa-sort-up"></i></th>
                                <th>Jumlah Kilogram <i class="fa-solid fa-sort-up"></i></th>
                                <th>ID Karyawan</th>
                                <th>Kode Booking</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($dataTransaksi as $row): ?>
                            <tr>
                                <td><?= $row['kode_transaksi'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= number_format($row['jumlah_kg'], 1, '.', '') ?></td>
                                <td><?= $row['id_karyawan'] ?></td>
                                <td><?= $row['kode_booking'] ?></td>
                                <td><a href="detail_transaksi.php"><button class="btn-aksi btn-detail">Detail</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </section>

        <footer class="footer">
            <p><i class="fa-solid fa-box"></i> Kelompok 4 2025</p>
        </footer>

    </main>
</div>

<script src="../js/skrip.js"></script>
</body>
</html>
