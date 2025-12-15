<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';

checkRole('admin');

// Ganti 'karyawan' table dengan 'user' WHERE role='karyawan'
$query = mysqli_query($koneksi, "SELECT user_id, nama, username, no_tlpn FROM user WHERE role='karyawan' ORDER BY nama ASC");
$karyawan_list = mysqli_fetch_all($query, MYSQLI_ASSOC);

$page = 'karyawan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan - Super Wash Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo-area">
                <img src="../img/superwash_logo.png" alt="Logo" />
            </div>
            <nav class="menu">
                <a href="index.php" >
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
                <h1 class="page-title">Daftar Karyawan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>

            <div class="content">
                <div class="table-card">
                    <div class="table-header">
                        <h2>Kelola Karyawan</h2>
                        <a href="addkaryawan.php" class="btn-add">
                            <i class="fa-solid fa-plus"></i> Tambah Karyawan
                        </a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>No. HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (count($karyawan_list) > 0) {
                                $no = 1;
                                foreach ($karyawan_list as $row) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_tlpn'] ?? '-'); ?></td>
                                <td>
                                    <a href="editkaryawan.php?id=<?php echo urlencode($row['user_id']); ?>" class="btn-action">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <button class="btn-action btn-delete" onclick="hapusKaryawan('<?php echo $row['user_id']; ?>')">
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
                                    Belum ada data karyawan
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
        function hapusKaryawan(id) {
            if (!confirm('Yakin ingin menghapus karyawan ini?')) return;
            
            fetch('../backend/process/hapus_karyawan.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'user_id=' + encodeURIComponent(id)
            })
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    alert('Berhasil dihapus');
                    location.reload();
                } else {
                    alert('Error: ' + d.message);
                }
            })
            .catch(e => alert('Error: ' + e));
        }
    </script>
</body>
</html>
