<?php
// Mendapatkan Kode Booking dari URL (Misalnya: ?kode=BK0003)
$kode_booking_edit = isset($_GET['kode']) ? htmlspecialchars($_GET['kode']) : 'BK0003'; 

// --- Data Dummy (Diambil dari data pesanan.php) ---
$dataPesanan = [
    ['kode_booking' => 'BK0001', 'nama' => 'nana', 'no_handphone' => '082345673455', 'tanggal' => '2025-11-29', 'nama_paket' => 'Cuci Paket', 'jenis_cuci' => 'regular', 'jumlah' => 1.8, 'estimasi' => 3, 'total_harga' => 10800],
    ['kode_booking' => 'BK0002', 'nama' => 'sani', 'no_handphone' => '082345673456', 'tanggal' => '2025-11-29', 'nama_paket' => 'Cuci Paket', 'jenis_cuci' => 'regular', 'jumlah' => 1.5, 'estimasi' => 3, 'total_harga' => 9000],
    ['kode_booking' => 'BK0003', 'nama' => 'Budi', 'no_handphone' => '082345673457', 'tanggal' => '10/06/2025', 'nama_paket' => 'Cuci Kering', 'jenis_cuci' => 'regular', 'jumlah' => 1.8, 'estimasi' => 3, 'total_harga' => 10800], // Data yang di-mockup
    ['kode_booking' => 'BK0004', 'nama' => 'Cinta', 'no_handphone' => '082345673458', 'tanggal' => '2025-11-30', 'nama_paket' => 'Setrika', 'jenis_cuci' => '-', 'jumlah' => 3.0, 'estimasi' => 4, 'total_harga' => 12000],
];

// Cari data pesanan yang akan diedit
$data_edit = null;
foreach ($dataPesanan as $pesanan) {
    if ($pesanan['kode_booking'] == $kode_booking_edit) {
        $data_edit = $pesanan;
        break;
    }
}

// Jika data tidak ditemukan (seperti di mockup)
if (!$data_edit) {
    // Default value untuk menyesuaikan mockup image_d25098.png
    $data_edit = [
        'kode_booking' => $kode_booking_edit,
        'nama' => 'nana',
        'no_handphone' => '082393717521',
        'tanggal' => '10/06/2025',
        'nama_paket' => 'Cuci Kering',
        'jenis_cuci' => 'Regular',
        'jumlah' => 1.8,
        'estimasi' => 3,
        'total_harga' => 10800,
    ];
}


// Data dropdown paket
$semuaPaket = [
    ['code' => 'Cuci Paket', 'name' => 'Cuci Paket'],
    ['code' => 'Cuci Kering', 'name' => 'Cuci Kering'],
    ['code' => 'Cuci Basah', 'name' => 'Cuci Basah'],
    ['code' => 'Boneka', 'name' => 'Boneka'],
    ['code' => 'Helm', 'name' => 'Helm'],
];

// Data dropdown jenis cuci
$jenisCuci = ['Regular', 'Ekspress', 'Setrika Saja', '-'];

// Mengatur halaman aktif
$page = 'pesanan.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Wash Dashboard - Edit Pesanan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">

    <style>
        /* CSS Tambahan untuk Halaman Edit/Tambah Pesanan */
        
        /* Judul dan Tombol Kembali di Header */
        .top-bar {
            /* Pastikan top-bar tetap kuning sesuai mockup */
            background-color: #ffd700;
        }

        .page-title.form-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            color: #000000;
        }

        /* Tombol Kembali di pojok kanan atas */
        .btn-kembali {
            background-color: #e67e22;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-kembali:hover {
            background-color: #d35400;
        }

        /* FORM STYLING (Diambil dari jawaban tambah_pesanan.php) */
        .form-container {
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            border: 2px solid #e67e22;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
        }

        .form-row label {
            flex: 0 0 150px; 
            font-weight: 500;
            color: #333;
        }

        .form-row input[type="text"],
        .form-row input[type="number"],
        .form-row select {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.2s;
            background-color: #f8f8f8;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        .form-row input[readonly] {
            background-color: #eee; 
            color: #777;
        }

        .form-row input:focus,
        .form-row select:focus {
            border-color: #e67e22;
            box-shadow: 0 0 5px rgba(230, 126, 34, 0.3);
            background-color: white;
        }
        
        .input-date-wrapper {
            position: relative;
            flex: 1;
        }
        .input-date-wrapper i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #e67e22;
            pointer-events: none;
        }

        .form-row select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23e67e22'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            padding-right: 30px; 
        }

        .form-actions {
            display: flex;
            justify-content: flex-start; 
            gap: 15px;
            padding-top: 10px;
            margin-left: 150px; 
        }

        /* Tombol Simpan (di mockup edit hanya ada Simpan) */
        .btn-simpan {
            padding: 10px 30px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.2s;
            background-color: #e67e22;
            color: white;
        }
        
        .btn-simpan:hover {
            opacity: 0.9;
        }
        
        /* Responsiveness Form */
        @media (max-width: 768px) {
            .form-container {
                margin: 20px;
                padding: 15px;
            }

            .page-title.form-title {
                position: static;
                transform: none;
                text-align: center;
                margin-bottom: 10px;
            }
            
            .top-bar {
                justify-content: space-between;
            }
            .left-nav {
                position: static;
            }
            .btn-kembali {
                position: static;
            }

            .form-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-row label {
                flex: none;
                margin-bottom: 5px;
            }

            .form-row input[type="text"],
            .form-row input[type="number"],
            .form-row select,
            .input-date-wrapper {
                width: 100%;
                flex: none;
            }

            .form-actions {
                margin-left: 0;
                justify-content: center;
            }
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
        
        <nav class="menu">
            <a href="index.php" class="<?= ($page == 'index.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Beranda
            </a>
            <a href="transaksi.php" class="<?= ($page == 'transaksi.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-wallet"></i> Transaksi
            </a>
            <a href="pesanan.php" class="active"> 
                <i class="fa-solid fa-cart-shopping"></i> Pesanan
            </a>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="top-bar">
            <div class="left-nav">
                <button id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
            </div>
            
            <h2 class="page-title form-title">Edit Data Pesanan</h2>
            
            <a href="pesanan.php" class="btn-kembali">Kembali</a>
        </header>

        <section class="transaction-data-section">
            <div class="form-container">
                <form action="proses_edit_pesanan.php" method="POST">
                    
                    <input type="hidden" name="kode_lama" value="<?= htmlspecialchars($data_edit['kode_booking']) ?>">
                    
                    <div class="form-row">
                        <label for="kode_booking">Kode Booking</label>
                        <input type="text" id="kode_booking" name="kode_booking" value="<?= htmlspecialchars($data_edit['kode_booking']) ?>" readonly>
                    </div>

                    <div class="form-row">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data_edit['nama']) ?>" required>
                    </div>

                    <div class="form-row">
                        <label for="no_hp">No HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="<?= htmlspecialchars($data_edit['no_handphone']) ?>" required>
                    </div>

                    <div class="form-row">
                        <label for="tanggal">Tanggal</label>
                        <div class="input-date-wrapper">
                            <input type="text" id="tanggal" name="tanggal" value="<?= htmlspecialchars($data_edit['tanggal']) ?>" placeholder="dd/mm/yyyy" required>
                            <i class="fa-solid fa-calendar-alt"></i>
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="nama_paket">Nama Paket</label>
                        <select id="nama_paket" name="nama_paket" required>
                            <option value="">-- Pilih Nama Paket --</option>
                            <?php foreach($semuaPaket as $paket): ?>
                                <option value="<?= htmlspecialchars($paket['code']) ?>"
                                    <?= ($paket['code'] == $data_edit['nama_paket']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($paket['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="jenis_cuci">Jenis Cuci</label>
                        <select id="jenis_cuci" name="jenis_cuci" required>
                            <option value="">-- Pilih Jenis Cuci --</option>
                            <?php foreach($jenisCuci as $jenis): ?>
                                <option value="<?= htmlspecialchars($jenis) ?>"
                                    <?= ($jenis == $data_edit['jenis_cuci']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars(ucwords($jenis)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" step="0.1" min="0.1" 
                            value="<?= number_format($data_edit['jumlah'], 1, '.', '') ?>" 
                            placeholder="e.g. 1.5 (Kilogram) atau 1 (Satuan)" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="estimasi">Estimasi (Hari)</label>
                        <input type="number" id="estimasi" name="estimasi" min="1" 
                            value="<?= htmlspecialchars($data_edit['estimasi']) ?>" 
                            placeholder="Estimasi (Hari)" required>
                    </div>

                    <div class="form-row">
                        <label for="total_harga">Total Harga (Rp)</label>
                        <input type="text" id="total_harga" name="total_harga" 
                            value="<?= number_format($data_edit['total_harga'], 0, ',', '.') ?>" 
                            placeholder="Total Harga (Rp)" readonly>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-simpan">Simpan</button>
                        </div>

                </form>
            </div>
        </section>

        <footer class="footer">
            <p><i class="fa-solid fa-box"></i> Kelompok 4 2025</p>
        </footer>

    </main>
</div>

<script src="../js/skrip.js"></script>
</body>
</html>
