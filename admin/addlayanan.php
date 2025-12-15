<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';

checkRole('admin');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Layanan - Super Wash Admin</title>
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
                <a href="index.php">
                    <i class="fa-solid fa-home"></i> <span>Beranda</span>
                </a>
                <a href="karyawan.php">
                    <i class="fa-solid fa-users"></i> <span>Karyawan</span>
                </a>
                <a href="layanan.php" class="active">
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
                <h1 class="page-title">Tambah Layanan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>

            <div class="content">
                <a href="layanan.php" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>

                <div class="form-card">
                    <h2><i class="fa-solid fa-plus-circle"></i> Form Tambah Layanan</h2>

                    <form action="../backend/process/tambah_layanan.php" method="POST">
                        <div class="form-group">
                            <label for="nama_layanan">Nama Layanan *</label>
                            <input type="text" id="nama_layanan" name="nama_layanan" placeholder="Contoh: Cuci Kering" required>
                        </div>

                        <div class="form-group">
                            <label for="harga_satuan">Harga per kg (Rp) *</label>
                            <input type="number" id="harga_satuan" name="harga_satuan" placeholder="Contoh: 7500" min="1000" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi layanan (opsional)" style="resize: vertical;"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Status Layanan *</label>
                            <div style="display: flex; gap: 20px;">
                                <label style="display: flex; align-items: center; gap: 8px;">
                                    <input type="radio" name="aktif" value="Y" checked required>
                                    <span>✓ Aktif</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px;">
                                    <input type="radio" name="aktif" value="N" required>
                                    <span>✗ Nonaktif</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="fa-solid fa-save"></i> Simpan
                            </button>
                            <button type="reset" class="btn-clear">
                                <i class="fa-solid fa-redo"></i> Bersihkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="footer">
                <i class="fa-solid fa-box"></i> Kelompok 4 2025
            </footer>
        </main>
    </div>
</body>
</html>
