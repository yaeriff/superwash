<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';

checkRole('owner');

$error = '';
$nama = $username = $no_tlpn = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama'] ?? '');
    $username = mysqli_real_escape_string($koneksi, $_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $no_tlpn = mysqli_real_escape_string($koneksi, $_POST['no_tlpn'] ?? '');

    if (empty($nama) || empty($username) || empty($password)) {
        $error = 'Nama, username, dan password harus diisi!';
    } else {
        $check = mysqli_query($koneksi, "SELECT user_id FROM user WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) {
            $error = 'Username sudah terdaftar!';
        } else {
            // Generate user_id otomatis (U0001, U0002, dll)
            $result = mysqli_query($koneksi, "SELECT MAX(CAST(SUBSTRING(user_id, 2) AS UNSIGNED)) as max_id FROM user WHERE user_id LIKE 'U%'");
            $row = mysqli_fetch_assoc($result);
            $next_id = ($row['max_id'] ?? 0) + 1;
            $user_id = 'U' . str_pad($next_id, 4, '0', STR_PAD_LEFT);
            
            // Encrypt password dengan md5
            $password_hash = md5($password);
            
            // INSERT dengan user_id yang sudah di-generate
            $query = "INSERT INTO user (user_id, nama, username, password, no_tlpn, role) 
                      VALUES ('$user_id', '$nama', '$username', '$password_hash', '$no_tlpn', 'karyawan')";

            if (mysqli_query($koneksi, $query)) {
                header('Location: karyawan.php?status=added&message=Karyawan berhasil ditambahkan');
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
    <title>Tambah Karyawan - Owner</title>
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
                <img src="../img/superwashlogo.png" alt="Logo" />
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
                <h1 class="page-title">Tambah Karyawan</h1>
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
                    <h2><i class="fa-solid fa-user-plus"></i> Tambah Karyawan Baru</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap *</label>
                            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" value="<?php echo htmlspecialchars($nama); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" id="username" name="username" placeholder="Masukkan username" value="<?php echo htmlspecialchars($username); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        </div>

                        <div class="form-group">
                            <label for="no_tlpn">No. Telepon (Opsional)</label>
                            <input type="text" id="no_tlpn" name="no_tlpn" placeholder="Nomor telepon" value="<?php echo htmlspecialchars($no_tlpn); ?>">
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
