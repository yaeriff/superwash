<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';

checkRole('admin');

// Get all layanan
$query = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY nama_layanan ASC");
$layanan_list = mysqli_fetch_all($query, MYSQLI_ASSOC);

$page = 'layanan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - Super Wash Admin</title>
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
        .status-aktif { background-color: #d1e7dd; color: #0f5132; }
        .status-nonaktif { background-color: #f8d7da; color: #842029; }
        .toggle-aktif {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            border: none;
            font-weight: 600;
        }
        .layanan-id {
            font-weight: 600;
            color: #e67e22;
            font-family: monospace;
        }
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
                <a href="karyawan.php">
                    <i class="fa-solid fa-users"></i> <span>Karyawan</span>
                </a>
                <a href="layanan.php">
                    <i class="fa-solid fa-list"></i> <span>Layanan</span>
                </a>
                <a href="transaksi.php">
                    <i class="fa-solid fa-wallet"></i> <span>Transaksi</span>
                </a>
                <a href="pesanan.php">
                    <i class="fa-solid fa-shopping-cart"></i> <span>Pesanan</span>
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-bar">
                <h1 class="page-title">Kelola Layanan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>

            <div class="content">
                <div class="table-card">
                    <div class="table-header">
                        <h2>Daftar Layanan</h2>
                        <a href="addlayanan.php" class="btn-add">
                            <i class="fa-solid fa-plus"></i> Tambah Layanan
                        </a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Layanan ID</th>
                                <th>Nama Layanan</th>
                                <th>Harga/kg</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (count($layanan_list) > 0) {
                                foreach ($layanan_list as $row) {
                                    $status_class = $row['aktif'] == 'Y' ? 'status-aktif' : 'status-nonaktif';
                                    $status_text = $row['aktif'] == 'Y' ? 'Aktif' : 'Nonaktif';
                            ?>
                            <tr>
                                <td><span class="layanan-id"><?php echo htmlspecialchars($row['layanan_id']); ?></span></td>
                                <td><?php echo htmlspecialchars($row['nama_layanan']); ?></td>
                                <td>Rp <?php echo number_format($row['harga_satuan'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($row['deskripsi'] ?? '-'); ?></td>
                                <td>
                                    <button class="toggle-aktif" onclick="toggleAktif(<?php echo $row['layanan_id']; ?>, '<?php echo $row['aktif']; ?>')" 
                                        style="background-color: <?php echo $row['aktif'] == 'Y' ? '#28a745' : '#dc3545'; ?>; color: white;">
                                        <span id="status-<?php echo $row['layanan_id']; ?>"><?php echo $status_text; ?></span>
                                    </button>
                                </td>
                                <td>
                                    <a href="editlayanan.php?id=<?php echo urlencode($row['layanan_id']); ?>" class="btn-action">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <button class="btn-action btn-delete" onclick="hapusLayanan(<?php echo $row['layanan_id']; ?>)">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 30px; color: #999;">
                                    <i class="fa-solid fa-inbox" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                                    Belum ada data layanan
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="footer">
                <i class="fa-solid fa-box"></i> Kelompok 4 2025
            </footer>
        </main>
    </div>

    <script>
        function toggleAktif(id, status_saat_ini) {
            const status_baru = status_saat_ini == 'Y' ? 'N' : 'Y';
            const status_text = status_baru == 'Y' ? 'Aktif' : 'Nonaktif';
            
            fetch('../backend/process/toggle_layanan.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'layanan_id=' + encodeURIComponent(id) + '&aktif=' + encodeURIComponent(status_baru)
            })
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    document.getElementById('status-' + id).textContent = status_text;
                    alert('Status berhasil diubah menjadi ' + status_text);
                    location.reload();
                } else {
                    alert('Error: ' + d.message);
                }
            })
            .catch(e => alert('Error: ' + e));
        }

        function hapusLayanan(id) {
            if (!confirm('Yakin ingin menghapus layanan ini?')) return;
            
            fetch('../backend/process/hapus_layanan.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'layanan_id=' + encodeURIComponent(id)
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
