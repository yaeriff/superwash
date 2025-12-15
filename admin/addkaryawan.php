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
        <title>Tambah Karyawan - Super Wash Owner</title>
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
                    <h1 class="page-title">Tambah Karyawan</h1>
                    <a href="../logout.php" class="logout-btn">Logout</a>
                </header>
                <div class="content">
                    <a href="karyawan.php" class="btn-back">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <div class="form-card">
                        <h2><i class="fa-solid fa-user-plus"></i> Form Tambah Karyawan</h2>
                        <form action="../backend/process/tambah_karyawan.php" method="POST">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" placeholder="Masukkan nama karyawan" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                            </div>
                            <div class="form-group">
                                <label for="notlpn">No. Telepon</label>
                                <input type="text" id="no_tlpn" name="no_tlpn" placeholder="08123456789">
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