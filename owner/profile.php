<?php
include '../koneksi.php';

// --- SIMULASI LOGIN ---
// pura-pura sg login adalah OWNER01
$id_pengguna_sekarang = 'OWNER01'; 

$query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id_karyawan='$id_pengguna_sekarang'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Saya - Super Wash</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">

    <style>
        .profile-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
        }

        /* Kartu Kiri (Foto) */
        .profile-card-left {
            flex: 1;
            max-width: 300px;
            background: white;
            border: 2px solid #e67e22;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .profile-img-box {
            width: 120px;
            height: 120px;
            background-color: #1a253a;
            color: #ffd700;
            font-size: 50px;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
            border: 4px solid #f1f1f1;
        }

        .profile-role {
            background-color: #ffd700;
            color: #1a253a;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 10px;
        }

        /* Kartu Kanan (Form) */
        .profile-card-right {
            flex: 2;
            background: white;
            border: 2px solid #e67e22;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1a253a;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        .form-row { display: flex; align-items: center; margin-bottom: 15px; }
        .form-row label { width: 180px; font-weight: 500; color: #555; }
        .form-row input { flex: 1; padding: 10px 15px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa; outline: none; }
        .form-row input:focus { background-color: #fff; border-color: #e67e22; }
        
        .btn-update-profile {
            background-color: #e67e22;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn-update-profile:hover { background-color: #d35400; }

        @media (max-width: 768px) {
            .profile-container { flex-direction: column; }
            .profile-card-left, .profile-card-right { width: 100%; max-width: 100%; }
            .form-row { flex-direction: column; align-items: flex-start; }
            .form-row label { margin-bottom: 5px; }
        }
    </style>
</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder"><span><img src="img/superwash_logo.png" alt=""></span></div>
        </div>
        <nav class="menu">
            <a href="index.php"><i class="fa-solid fa-house"></i> Beranda</a>
            <a href="karyawan.php"><i class="fa-solid fa-users"></i> Karyawan</a>
            <a href="transaksi.php"><i class="fa-solid fa-wallet"></i> Transaksi</a>
            <a href="pesanan.php"><i class="fa-solid fa-cart-shopping"></i> Pesanan</a>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="top-bar">
            <div class="left-nav"><button id="toggleSidebar"><i class="fa-solid fa-bars"></i></button></div>
            <h2 class="page-title">Profile Saya</h2>
            
            <div class="profile-dropdown">
                <div class="profile-trigger" id="profileTrigger">
                    <div class="profile-icon">O</div>
                    <span class="profile-name">Menu Profile<i class="fa-solid fa-caret-down"></i></span>
                </div>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="profile.php"><i class="fa-regular fa-user" style="margin-right: 8px;"></i> Profile</a>
                    <a href="../logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i> Logout</a>
                </div>
            </div>
        </header>

        <div class="profile-container">
            
            <div class="profile-card-left">
                <div class="profile-img-box">
                    <?= substr($data['nama'], 0, 1) ?>
                </div>
                <h3 style="margin-bottom: 5px;"><?= $data['nama'] ?></h3>
                <span class="profile-role">Super Admin</span>
                <p style="color: #777; font-size: 13px; margin-top: 15px;">
                    <i class="fa-solid fa-location-dot"></i> <?= $data['alamat'] ?>
                </p>
                <p style="color: #777; font-size: 13px;">
                    Bergabung sejak 2025
                </p>
            </div>

            <div class="profile-card-right">
                <h4 class="section-title">Edit Biodata Diri</h4>
                
                <form action="../proses_edit_profile.php" method="POST">
                    <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan'] ?>">

                    <div class="form-row">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="<?= $data['nama'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>No Handphone</label>
                        <input type="text" name="nohp" value="<?= $data['nohp'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="<?= $data['alamat'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>Username</label>
                        <input type="text" name="username" value="<?= $data['username'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>Password Baru</label>
                        <input type="text" name="password" value="<?= $data['password'] ?>" placeholder="Isi jika ingin ubah password">
                    </div>

                    <button type="submit" class="btn-update-profile">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>

        </div>

    </main>
</div>
<script src="../js/skrip.js?v=<?php echo time(); ?>"></script>
</body>
</html>