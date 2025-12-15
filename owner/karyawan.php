<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';

checkRole('owner');

$status = $_GET['status'] ?? '';
$message = $_GET['message'] ?? '';

$query = mysqli_query($koneksi, "SELECT user_id, nama, username, no_tlpn FROM user WHERE role='karyawan' ORDER BY nama ASC");
$karyawan_list = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan - Owner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .btn-group {
            display: flex;
            gap: 8px;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-edit {
            background-color: #e67e22;
            color: white;
        }
        .btn-edit:hover {
            background-color: #d35400;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c0392b;
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
                <a href="karyawan.php" class="active">
                    <i class="fa-solid fa-users"></i> <span>Karyawan</span>
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
                <a href="tambah_karyawan.php" class="btn-add" style="margin-bottom: 20px;">
                    <i class="fa-solid fa-plus"></i> Tambah Karyawan
                </a>

                <?php if ($status == 'added'): ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-check-circle"></i> <?php echo htmlspecialchars($message); ?>
                </div>
                <?php elseif ($status == 'updated'): ?>
                <div class="alert alert-info">
                    <i class="fa-solid fa-info-circle"></i> <?php echo htmlspecialchars($message); ?>
                </div>
                <?php elseif ($status == 'deleted'): ?>
                <div class="alert alert-warning">
                    <i class="fa-solid fa-check-circle"></i> <?php echo htmlspecialchars($message); ?>
                </div>
                <?php endif; ?>

                <?php if (empty($karyawan_list)): ?>
                <div class="alert alert-info">
                    <i class="fa-solid fa-info-circle"></i> Belum ada karyawan. <a href="tambah_karyawan.php">Tambah karyawan</a>
                </div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>No. Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($karyawan_list as $k): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($k['nama']); ?></td>
                                <td><?php echo htmlspecialchars($k['username']); ?></td>
                                <td><?php echo htmlspecialchars($k['no_tlpn'] ?? '-'); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <!-- TOMBOL EDIT -->
                                        <a href="edit_karyawan.php?id=<?php echo urlencode($k['user_id']); ?>" class="btn-action btn-edit">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                        
                                        <!-- TOMBOL HAPUS -->
                                        <button class="btn-action btn-delete" onclick="hapusKaryawan('<?php echo htmlspecialchars($k['user_id']); ?>')">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>

            <footer class="footer">
                <i class="fa-solid fa-box"></i> Kelompok 4 2025
            </footer>
        </main>
    </div>

    <script>
        function hapusKaryawan(user_id) {
            if (!confirm('Yakin ingin menghapus karyawan ini?')) {
                return;
            }
            
            fetch('../backend/process/hapus_karyawan.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'user_id=' + encodeURIComponent(user_id)
            })
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    alert('Karyawan berhasil dihapus');
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
