<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';
checkRole('admin');
$user_id = $_GET['id'] ?? '';
if (empty($user_id)) {
    header("Location: karyawan.php");
    exit;
}
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$user_id' AND role='karyawan'");
if (mysqli_num_rows($query) == 0) {
    header("Location: karyawan.php");
    exit;
}
$karyawan = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan - Super Wash Owner</title>
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
                <h1 class="page-title">Edit Karyawan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>
            <div class="content">
                <a href="karyawan.php" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <div class="form-card">
                    <h2><i class="fa-solid fa-user-edit"></i> Form Edit Karyawan</h2>
                    <form action="../backend/process/edit_karyawan.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $karyawan['user_id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($karyawan['nama']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($karyawan['username']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru (Kosongkan jika tidak ingin ubah)</label>
                            <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin ubah">
                        </div>
                        <div class="form-group">
                            <label for="no_tlpn">No. Telepon</label>
                            <input type="text" id="no_tlpn" name="no_tlpn" value="<?php echo htmlspecialchars($karyawan['no_tlpn'] ?? ''); ?>">
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="fa-solid fa-save"></i> Simpan Perubahan
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
