<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';
checkRole('karyawan');
$user_id = $_SESSION['user_id'];
$query = mysqli_query($koneksi, "
    SELECT p.pemesanan_id, p.nama_pemesan, p.no_pemesan, p.tanggal_pemesanan, 
           l.nama_layanan, p.jumlah_berat, p.total_bayar, p.status
    FROM pemesanan p 
    LEFT JOIN layanan l ON p.layanan_id = l.layanan_id 
    WHERE p.user_id='$user_id'
    ORDER BY p.tanggal_pemesanan DESC
");
$pesanan_list = mysqli_fetch_all($query, MYSQLI_ASSOC);
$page = 'pesanan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - Super Wash Karyawan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-diproses { background-color: #cfe2ff; color: #084298; }
        .status-selesai { background-color: #d1e7dd; color: #0f5132; }
        .status-batal { background-color: #f8d7da; color: #842029; }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo-area">
                <img src="../img/superwash_logo.png" alt="Logo" />
            </div>
            <nav class="menu">
                <a href="index.php">
                    <i class="fa-solid fa-home"></i> <span>Beranda</span>
                </a>
                <a href="pesanan.php" class="active">
                    <i class="fa-solid fa-shopping-cart"></i> <span>Pesanan</span>
                </a>
                <a href="transaksi.php">
                    <i class="fa-solid fa-wallet"></i> <span>Transaksi</span>
                </a>
            </nav>
        </aside>
        <main class="main-content">
            <header class="top-bar">
                <h1 class="page-title">Pesanan Saya</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>
            <div class="content">
                <div class="table-card">
                    <div class="table-header">
                        <h2>Daftar Pesanan</h2>
                        <a href="addpesanan.php" class="btn-add">
                            <i class="fa-solid fa-plus"></i> Tambah Pesanan
                        </a>
                    </div>
                    <div style="overflow-x: auto;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Pelanggan</th>
                                    <th>No. HP</th>
                                    <th>Tanggal</th>
                                    <th>Layanan</th>
                                    <th>Berat</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (count($pesanan_list) > 0) {
                                    foreach ($pesanan_list as $row) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['pemesanan_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_pemesan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_pemesan']); ?></td>
                                    <td><?php echo $row['tanggal_pemesanan']; ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_layanan'] ?? '-'); ?></td>
                                    <td><?php echo $row['jumlah_berat']; ?> kg</td>
                                    <td>Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $row['status']; ?>">
                                            <?php echo ucfirst($row['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="editpesanan.php?id=<?php echo urlencode($row['pemesanan_id']); ?>" class="btn-action">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                        <button class="btn-action btn-delete" onclick="hapusPesanan('<?php echo $row['pemesanan_id']; ?>')">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="9" style="text-align: center; padding: 30px; color: #1a253a;">
                                        <i class="fa-solid fa-inbox" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                                        Belum ada data pesanan
                                    </td>
                                </tr>
                                <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <i class="fa-solid fa-box"></i> Kelompok 4 2025
            </footer>
        </main>
    </div>
    <script>
        function hapusPesanan(id) {
            if (!confirm('Yakin ingin menghapus pesanan ini?')) return;
            fetch('../backend/process/hapus_pesanan.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'pemesanan_id=' + id
            })
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    alert('Berhasil dihapus');
                    location.reload();
                } else {
                    alert('Error: ' + d.message);
                }
            });
        }
    </script>
</body>
</html>
