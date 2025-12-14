<?php
include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE kode_booking='$id'");
$data  = mysqli_fetch_array($query);

if (!$data) {
    header("Location: pesanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan - Super Wash</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">

    <style>
        .form-section-wrapper { padding: 30px; display: flex; justify-content: center; }
        .form-card { background-color: white; width: 100%; padding: 30px; border: 2px solid #e67e22; border-radius: 5px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .form-row { display: flex; align-items: center; margin-bottom: 15px; }
        .form-row label { width: 200px; font-weight: 500; color: #1a253a; }
        .form-row input, .form-row select { flex: 1; padding: 10px 15px; border: 1px solid #ccc; border-radius: 5px; background-color: #e6e6e6; outline: none; }
        .form-row input:focus, .form-row select:focus { background-color: #fff; border-color: #e67e22; }
        .form-actions { margin-top: 30px; display: flex; gap: 10px; }
        .btn-back-header { background-color: #e67e22; color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; font-weight: 500; }
        .btn-save { background-color: #e67e22; color: white; border: none; padding: 10px 25px; border-radius: 5px; font-weight: 600; cursor: pointer; }
        
        /* Responsif HP */
        @media (max-width: 768px) { .form-row { flex-direction: column; align-items: flex-start; } .form-row label { width: 100%; margin-bottom: 5px; } .page-title { display: none; } }
    </style>
</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder"><span><img src="../img/superwash_logo.png" alt=""></span></div>
        </div>
        <nav class="menu">
            <a href="index.php"><i class="fa-solid fa-house"></i> Beranda</a>
            <a href="karyawan.php"><i class="fa-solid fa-users"></i> Karyawan</a>
            <a href="transaksi.php"><i class="fa-solid fa-wallet"></i> Transaksi</a>
            <a href="pesanan.php" class="active"><i class="fa-solid fa-cart-shopping"></i> Pesanan</a>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="top-bar">
            <div class="left-nav"><button id="toggleSidebar"><i class="fa-solid fa-bars"></i></button></div>
            <h2 class="page-title" style="position: static; transform: none; margin: 0 auto;">Edit Data Pesanan</h2>
            <a href="pesanan.php" class="btn-back-header">Kembali</a>
        </header>

        <section class="form-section-wrapper">
            <div class="form-card">
                <form action="proses_edit_pesanan.php" method="POST">
                    
                    <div class="form-row">
                        <label>Kode Booking</label>
                        <input type="text" name="kode_booking" value="<?= $data['kode_booking'] ?>" readonly style="cursor: not-allowed; background-color: #ddd;">
                    </div>

                    <div class="form-row">
                        <label>Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" value="<?= $data['nama_pelanggan'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>No Handphone</label>
                        <input type="text" name="no_handphone" value="<?= $data['no_handphone'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>Nama Paket</label>
                        <select name="nama_paket">
                            <option value="Cuci Paket" <?= ($data['nama_paket'] == 'Cuci Paket') ? 'selected' : '' ?>>Cuci Paket</option>
                            <option value="Cuci Komplit" <?= ($data['nama_paket'] == 'Cuci Komplit') ? 'selected' : '' ?>>Cuci Komplit</option>
                            <option value="Setrika Saja" <?= ($data['nama_paket'] == 'Setrika Saja') ? 'selected' : '' ?>>Setrika Saja</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label>Jenis Cuci</label>
                        <select name="jenis_cuci">
                            <option value="reguler" <?= ($data['jenis_cuci'] == 'reguler') ? 'selected' : '' ?>>Reguler</option>
                            <option value="express" <?= ($data['jenis_cuci'] == 'express') ? 'selected' : '' ?>>Express</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label>Jumlah (Kg)</label>
                        <input type="number" step="0.1" name="jumlah" value="<?= $data['jumlah'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>Estimasi (Hari)</label>
                        <input type="number" name="estimasi" value="<?= $data['estimasi'] ?>" required>
                    </div>

                    <div class="form-row">
                        <label>Total Harga</label>
                        <input type="number" name="total_harga" value="<?= $data['total_harga'] ?>" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">Update Data</button>
                    </div>

                </form>
            </div>
        </section>

    </main>
</div>
<script src="../js/skrip.js?v=<?php echo time(); ?>"></script>
</body>
</html>