<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan - Super Wash</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">

    <style>
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-row label {
            width: 200px;
            font-weight: 500;
            color: #1a253a;
        }

        .form-row input, 
        .form-row textarea {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #e6e6e6;
            font-family: 'Poppins', sans-serif;
            outline: none;
        }

        .form-row input:focus {
            background-color: #fff;
            border-color: #e67e22;
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder">
                <span><img src="../img/superwash_logo.png" alt="Super Wash Logo"></span>
            </div>
        </div>
        
        <?php $page = 'karyawan.php'; ?>
        <nav class="menu">
            <a href="index.php"><i class="fa-solid fa-house"></i> Beranda</a>
            <a href="karyawan.php" class="active"><i class="fa-solid fa-users"></i> Karyawan</a>
            <a href="transaksi.php"><i class="fa-solid fa-wallet"></i> Transaksi</a>
            <a href="pesanan.php"><i class="fa-solid fa-cart-shopping"></i> Pesanan</a>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="top-bar">
            <div class="left-nav">
                <button id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
            </div>
            
            <h2 class="page-title" style="position: static; transform: none; margin: 0 auto;">Tambah Data Karyawan</h2>

            <a href="karyawan.php" class="btn-back-header">Kembali</a>
        </header>

        <section class="form-section-wrapper">
            <div class="form-card">
                <form action="proses_tambah_karyawan.php" method="POST">
                    
                    <div class="form-row">
                        <label>ID Karyawan</label>
                        <input type="text" name="id_karyawan" value="K0001" readonly style="cursor: not-allowed; color: #555;">
                    </div>

                    <div class="form-row">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="" required>
                    </div>

                    <div class="form-row">
                        <label>No HP</label>
                        <input type="text" name="nohp" placeholder="" required>
                    </div>

                    <div class="form-row">
                        <label>Alamat</label>
                        <input type="text" name="alamat" placeholder="" required>
                    </div>

                    <div class="form-row">
                        <label>Nama Pengguna</label>
                        <input type="text" name="username" placeholder="" required>
                    </div>

                    <div class="form-row">
                        <label>Kata Sandi</label>
                        <input type="password" name="password" placeholder="" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">Simpan</button>
                        <button type="reset" class="btn-clear">Bersihkan</button>
                    </div>

                </form>
            </div>
        </section>

    </main>
</div>

<script src="../js/skrip.js"></script>
</body>
</html>