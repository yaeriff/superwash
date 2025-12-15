<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';

checkRole('owner');

$user_id = $_GET['id'] ?? '';
$error = '';

if (empty($user_id)) {
    header('Location: karyawan.php');
    exit;
}

$query = mysqli_query($koneksi, "SELECT user_id, nama, username, no_tlpn FROM user WHERE user_id='$user_id' AND role='karyawan'");
if (mysqli_num_rows($query) == 0) {
    header('Location: karyawan.php');
    exit;
}

$karyawan = mysqli_fetch_assoc($query);
$nama = $karyawan['nama'];
$username = $karyawan['username'];
$no_tlpn = $karyawan['no_tlpn'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama'] ?? '');
    $username_baru = mysqli_real_escape_string($koneksi, $_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $no_tlpn = mysqli_real_escape_string($koneksi, $_POST['no_tlpn'] ?? '');

    if (empty($nama) || empty($username_baru)) {
        $error = 'Nama dan username harus diisi!';
    } else {
        $check = mysqli_query($koneksi, "SELECT user_id FROM user WHERE username='$username_baru' AND user_id!='$user_id'");
        if (mysqli_num_rows($check) > 0) {
            $error = 'Username sudah digunakan!';
        } else {
            if (!empty($password)) {
                // Gunakan md5 untuk password varchar(20)
                $password_hash = md5($password);
                $update_query = "UPDATE user SET nama='$nama', username='$username_baru', password='$password_hash', no_tlpn='$no_tlpn' WHERE user_id='$user_id'";
            } else {
                $update_query = "UPDATE user SET nama='$nama', username='$username_baru', no_tlpn='$no_tlpn' WHERE user_id='$user_id'";
            }

            if (mysqli_query($koneksi, $update_query)) {
                header('Location: karyawan.php?status=updated&message=Karyawan berhasil diperbarui');
                exit;
            } else {
                $error = 'Error: ' . mysqli_error($koneksi);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan - Owner</title>
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
                <h1 class="page-title">Edit Karyawan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>
            <div class="content">
                <a href="karyawan.php" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>

                <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="fa-solid fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
                <?php endif; ?>

                <div class="form-card">
                    <h2><i class="fa-solid fa-edit"></i> Edit Karyawan</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap *</label>
                            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password (Kosongkan jika tidak diubah)</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan password baru">
                        </div>

                        <div class="form-group">
                            <label for="no_tlpn">No. Telepon</label>
                            <input type="text" id="no_tlpn" name="no_tlpn" value="<?php echo htmlspecialchars($no_tlpn); ?>">
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="fa-solid fa-save"></i> Simpan
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
