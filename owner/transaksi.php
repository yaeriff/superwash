<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Super Wash</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">
</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder">
                <span><img src="../img/superwash_logo.png" alt=""></span>
            </div>
        </div>
        
        <?php $page = basename($_SERVER['PHP_SELF']); ?>
        <nav class="menu">
            <a href="index.php" class="<?= ($page == 'index.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Beranda
            </a>
            <a href="karyawan.php" class="<?= ($page == 'karyawan.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i> Karyawan
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
        </header>

        <section class="table-section">
            
            <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
                <a href="grafikpenjualan.php" class="btn-grafik">
                    <i class="fa-solid fa-chart-line"></i> Lihat Grafik Penjualan
                </a>
            </div>

            <div class="table-responsive">
                <table id="tabelTransaksi" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Tanggal</th>
                            <th>Jumlah Kilogram</th>
                            <th>id_karyawan</th>
                            <th>Kode Booking</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $query = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY tanggal DESC");
                        while($row = mysqli_fetch_array($query)): 
                        ?>
                        <tr>
                            <td><?= $row['kode_transaksi'] ?></td>
                            <td><?= $row['tanggal'] ?></td> <td><?= $row['jumlah_kg'] ?></td>
                            <td><?= $row['id_karyawan'] ?></td>
                            <td><?= $row['kode_booking'] ?></td>
                            <td>
                                <button class="btn-detail">Detail</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </section>

        <footer class="footer">
            <p><i class="fa-solid fa-save"></i> Kelompok 4 2025</p>
        </footer>

    </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="../js/skrip.js?t=<?php echo time(); ?>"></script>

<script>
    $(document).ready(function () {
        $('#tabelTransaksi').DataTable({
            columnDefs: [{ orderable: false, targets: 5 }],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Lanjut",
                    previous: "Kembali"
                }
            }
        });
    });
</script>

</body>
</html>