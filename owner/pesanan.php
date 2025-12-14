<?php
include '../koneksi.php';

function formatRupiah($angka){
    return number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan - Super Wash</title>
    
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
            <a href="index.php"><i class="fa-solid fa-house"></i> Beranda</a>
            <a href="karyawan.php"><i class="fa-solid fa-users"></i> Karyawan</a>
            <a href="transaksi.php"><i class="fa-solid fa-wallet"></i> Transaksi</a>
            <a href="pesanan.php" class="active"><i class="fa-solid fa-cart-shopping"></i> Pesanan</a>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="top-bar">
            <div class="left-nav">
                <button id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
            </div>
            <h2 class="page-title">Pesanan</h2>
        </header>

        <section class="table-section">
            
            <div class="table-responsive">
                <table id="tabelPesanan" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Nama</th>
                            <th>No Handphone</th>
                            <th>Tanggal</th>
                            <th>Nama Paket</th>
                            <th>Jenis Cuci</th>
                            <th>Jumlah</th>
                            <th>Estimasi</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $query = mysqli_query($koneksi, "SELECT * FROM pemesanan ORDER BY kode_booking DESC");
                        while($row = mysqli_fetch_array($query)): 
                        ?>
                        <tr>
                            <td><?= $row['kode_booking'] ?></td>
                            <td><?= $row['nama_pelanggan'] ?></td>
                            <td><?= $row['no_handphone'] ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            
                            <td>
                                <?= $row['nama_paket'] ?>
                            </td>
                            
                            <td><?= $row['jenis_cuci'] ?></td>
                            <td><?= $row['jumlah'] ?></td>
                            <td><?= $row['estimasi'] ?></td>
                            <td><?= formatRupiah($row['total_harga']) ?></td>
                            <td>
                                <a href="editpesanan.php?id=<?= $row['kode_booking'] ?>" class="btn-action-icon">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
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
        $('#tabelPesanan').DataTable({
            columnDefs: [{ orderable: false, targets: 9 }],
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