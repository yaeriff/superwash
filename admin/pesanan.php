<?php
$dataPesanan = [
    ['kode_booking' => 'BK0001', 'nama' => 'nana', 'no_handphone' => '082345673455', 'tanggal' => '2025-11-29', 'nama_paket' => 'Cuci Paket', 'jenis_cuci' => 'regular', 'jumlah' => 1.8, 'estimasi' => 3, 'total_harga' => 10800],
    ['kode_booking' => 'BK0002', 'nama' => 'sani', 'no_handphone' => '082345673456', 'tanggal' => '2025-11-29', 'nama_paket' => 'Cuci Paket', 'jenis_cuci' => 'regular', 'jumlah' => 1.5, 'estimasi' => 3, 'total_harga' => 9000],
    ['kode_booking' => 'BK0003', 'nama' => 'Budi', 'no_handphone' => '082345673457', 'tanggal' => '2025-11-30', 'nama_paket' => 'Cuci Kering', 'jenis_cuci' => 'ekspress', 'jumlah' => 2.0, 'estimasi' => 1, 'total_harga' => 15000],
    ['kode_booking' => 'BK0004', 'nama' => 'Cinta', 'no_handphone' => '082345673458', 'tanggal' => '2025-11-30', 'nama_paket' => 'Setrika', 'jenis_cuci' => '-', 'jumlah' => 3.0, 'estimasi' => 4, 'total_harga' => 12000],
    ['kode_booking' => 'BK0005', 'nama' => 'Dedy', 'no_handphone' => '082345673459', 'tanggal' => '2025-12-01', 'nama_paket' => 'Cuci Paket', 'jenis_cuci' => 'regular', 'jumlah' => 1.2, 'estimasi' => 3, 'total_harga' => 7200],
    ['kode_booking' => 'BK0006', 'nama' => 'Eka', 'no_handphone' => '082345673460', 'tanggal' => '2025-12-01', 'nama_paket' => 'Cuci Kering', 'jenis_cuci' => 'regular', 'jumlah' => 2.5, 'estimasi' => 2, 'total_harga' => 17500],
    ['kode_booking' => 'BK0007', 'nama' => 'Fani', 'no_handphone' => '082345673461', 'tanggal' => '2025-12-02', 'nama_paket' => 'Setrika', 'jenis_cuci' => '-', 'jumlah' => 1.5, 'estimasi' => 4, 'total_harga' => 6000],
    ['kode_booking' => 'BK0008', 'nama' => 'Gilang', 'no_handphone' => '082345673462', 'tanggal' => '2025-12-02', 'nama_paket' => 'Cuci Paket', 'jenis_cuci' => 'ekspress', 'jumlah' => 2.2, 'estimasi' => 1, 'total_harga' => 16500],
    ['kode_booking' => 'BK0009', 'nama' => 'Hari', 'no_handphone' => '082345673463', 'tanggal' => '2025-12-03', 'nama_paket' => 'Cuci Paket', 'jenis_cuci' => 'regular', 'jumlah' => 2.0, 'estimasi' => 3, 'total_harga' => 12000],
    ['kode_booking' => 'BK0010', 'nama' => 'Irma', 'no_handphone' => '082345673464', 'tanggal' => '2025-12-03', 'nama_paket' => 'Cuci Kering', 'jenis_cuci' => 'regular', 'jumlah' => 1.7, 'estimasi' => 2, 'total_harga' => 11900],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Wash Dashboard - Pesanan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style2.css?t=<?php echo time(); ?>">

    <style>
        .btn-aksi-group {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .btn-aksi.btn-hapus {
            background-color: #e74c3c; /* Merah untuk Hapus */
        }
        
        .btn-aksi.btn-hapus:hover {
            background-color: #c0392b; 
        }

        /* Pastikan style untuk btn-aksi dan btn-tambah sudah ada di style.css dari jawaban sebelumnya */
    </style>

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
            
            <h2 class="page-title">Pesanan</h2>
            
            <div class="search-and-admin">
                <div class="auth-info">
                     <div class="admin-avatar"><i class="fa-solid fa-user"></i></div>
                     <span class="admin-name">Hi, Admin <i class="fa-solid fa-caret-down"></i></span>
                </div>
            </div>
        </header>

        <section class="transaction-data-section">
            <div class="button-center-wrapper">
                <a href="tambah_pesanan.php" class="btn-aksi btn-tambah">
                    <i class="fa-solid fa-plus"></i> Tambah Pesanan
                </a>
            </div>
            
            <div class="data-table-container">
                
                <div class="data-table-header-controls">
                    <div class="length-control">
                        Tampilan 
                        <div class="select-wrapper"> 
                             <select name="data-length" id="data-length">
                                 <option value="10">10</option>
                                 <option value="25">25</option>
                                 <option value="50">50</option>
                             </select> 
                             <i class="fa-solid fa-caret-down"></i> 
                        </div> 
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
                                <th>Kode Booking <i class="fa-solid fa-sort-up"></i></th>
                                <th>Nama <i class="fa-solid fa-sort-up"></i></th>
                                <th>No Handphone</th>
                                <th>Tanggal</th>
                                <th>Nama Paket</th>
                                <th>Jenis Cuci</th>
                                <th>Jumlah <i class="fa-solid fa-sort-up"></i></th>
                                <th>Estimasi <i class="fa-solid fa-sort-up"></i></th>
                                <th>Total Harga <i class="fa-solid fa-sort-up"></i></th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($dataPesanan as $row): ?>
                            <tr>
                                <td><?= $row['kode_booking'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['no_handphone'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['nama_paket'] ?></td>
                                <td><?= $row['jenis_cuci'] ?></td>
                                <td><?= number_format($row['jumlah'], 1, '.', '') ?></td> 
                                <td><?= $row['estimasi'] ?></td>
                                <td><?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                <td>
                                    <div class="btn-aksi-group">
                                        <a href="edit_pesanan.php?kode=<?= $row['kode_booking'] ?>" class="btn-aksi" title="Edit Pesanan">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="hapus_pesanan.php?kode=<?= $row['kode_booking'] ?>" class="btn-aksi btn-hapus" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan <?= $row['kode_booking'] ?>?')"
                                           title="Hapus Pesanan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
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
