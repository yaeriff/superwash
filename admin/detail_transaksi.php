<?php
// Mendapatkan Kode Transaksi dari URL (Misalnya: ?kode=TR003)
$kode_transaksi = isset($_GET['kode']) ? htmlspecialchars($_GET['kode']) : 'TR003'; 

// --- Data Dummy Transaksi dan Pesanan Terkait (Mocking Database Fetch) ---
// Data Transaksi
$transaksi_detail = [
    'kode_transaksi' => $kode_transaksi,
    'tanggal_transaksi' => '2025-11-30',
    'nama_pelanggan' => 'Budi',
    'no_handphone' => '082345673457',
    'status_bayar' => 'Diproses',
    'metode_bayar' => 'Cash',
    'subtotal' => 15000,
    'diskon' => 0,
    'total_akhir' => 15000,
];

// Detail Pesanan/Item dalam Transaksi (asumsi bisa lebih dari satu item/pesanan)
$pesanan_items = [
    [
        'kode_pesanan' => 'BK0003',
        'nama_paket' => 'Cuci Kering',
        'jenis_cuci' => 'Ekspress',
        'jumlah' => 2.0, // kg
        'satuan' => 'kg',
        'harga_per_unit' => 7500,
        'sub_total' => 15000,
        'status_pesanan' => 'Sedang Dicuci'
    ],
    // Jika ada item lain, tambahkan di sini
];

// Mengatur halaman aktif
$page = 'transaksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Wash Dashboard - Detail Transaksi</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">

    <style>
        /* CSS Khusus untuk Halaman Detail Transaksi */
        
        /* HEADER: Mengganti Top Bar menjadi Kuning */
        .main-content .top-bar {
            background-color: #ffd700;
            box-shadow: none; /* Menghilangkan shadow jika ada */
        }
        .main-content .page-title {
            color: #000000; 
        }

        /* Tombol Kembali di pojok kanan */
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

        /* DETAIL CONTAINER STYLING */
        .detail-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            border: 2px solid #e67e22; /* Border oranye */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .detail-section h3 {
            border-bottom: 2px solid #ffd700; /* Garis kuning pemisah section */
            padding-bottom: 5px;
            margin-bottom: 15px;
            color: #1a253a;
            font-weight: 600;
        }

        .detail-row {
            display: flex;
            margin-bottom: 10px;
            font-size: 15px;
        }
        
        .detail-row .label {
            flex: 0 0 180px; /* Lebar label tetap */
            font-weight: 500;
            color: #555;
        }

        .detail-row .value {
            flex: 1;
            font-weight: 600;
            color: #1a253a;
        }

        /* Status Styling (Sesuai dengan warna Transaksi) */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .status-selesai {
            background-color: #2ecc71; /* Hijau */
            color: white;
        }

        .status-diproses {
            background-color: #e67e22; /* Oranye */
            color: white;
        }
        
        /* Style untuk Tabel Detail Pesanan */
        .pesanan-detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        .pesanan-detail-table th, .pesanan-detail-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .pesanan-detail-table th {
            background-color: #f5f5f5;
            font-weight: 600;
            color: #333;
        }
        
        /* Ringkasan Pembayaran */
        .summary-box {
            margin-top: 25px;
            padding: 15px;
            border-top: 2px solid #e67e22;
            background-color: #fffefd;
            text-align: right;
            border-radius: 0 0 10px 10px;
        }

        .summary-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .summary-row .label {
            width: 150px;
            font-weight: 500;
            color: #555;
        }

        .summary-row .value {
            width: 150px;
            font-weight: 600;
            color: #1a253a;
        }
        
        .summary-row.total .value {
            font-size: 18px;
            font-weight: 700;
            color: #e67e22;
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .detail-container {
                margin: 15px;
                padding: 15px;
            }
            .detail-row {
                flex-direction: column;
                margin-bottom: 5px;
            }
            .detail-row .label {
                flex: none;
                margin-bottom: 2px;
                font-weight: 600;
                color: #1a253a;
            }
            .detail-row .value {
                flex: none;
                font-weight: 400;
                color: #555;
                margin-left: 10px;
            }
            
            .summary-row {
                font-size: 14px;
            }
            
            .summary-row .label, .summary-row .value {
                width: 100px;
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
            <a href="transaksi.php" class="active">
                <i class="fa-solid fa-wallet"></i> Transaksi
            </a>
            <a href="pesanan.php" class="<?= ($page == 'pesanan.php') ? 'active' : '' ?>"> 
                <i class="fa-solid fa-cart-shopping"></i> Pesanan
            </a>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="top-bar">
            <div class="left-nav">
                <button id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
            </div>
            
            <h2 class="page-title">Detail Data Transaksi</h2>
            
            <a href="transaksi.php" class="btn-kembali">Kembali</a>
        </header>

        <section class="transaction-data-section">
            <div class="detail-container">
                
                <div class="detail-section">
                    <h3>Data Transaksi</h3>
                    <div class="detail-row">
                        <span class="label">Kode Transaksi:</span>
                        <span class="value"><?= htmlspecialchars($transaksi_detail['kode_transaksi']) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Tanggal Transaksi:</span>
                        <span class="value"><?= htmlspecialchars($transaksi_detail['tanggal_transaksi']) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Nama Pelanggan:</span>
                        <span class="value"><?= htmlspecialchars($transaksi_detail['nama_pelanggan']) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="label">No. Handphone:</span>
                        <span class="value"><?= htmlspecialchars($transaksi_detail['no_handphone']) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Status Pembayaran:</span>
                        <span class="value">
                            <span class="status-badge status-<?= strtolower($transaksi_detail['status_bayar']) ?>">
                                <?= htmlspecialchars($transaksi_detail['status_bayar']) ?>
                            </span>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Metode Pembayaran:</span>
                        <span class="value"><?= htmlspecialchars($transaksi_detail['metode_bayar']) ?></span>
                    </div>
                </div>

                <div class="detail-section" style="margin-top: 25px;">
                    <h3>Detail Pesanan (Item)</h3>
                    <table class="pesanan-detail-table">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Nama Paket</th>
                                <th>Jenis Cuci</th>
                                <th>Jumlah</th>
                                <th>Harga/Unit</th>
                                <th>Subtotal</th>
                                <th>Status Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pesanan_items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['kode_pesanan']) ?></td>
                                <td><?= htmlspecialchars($item['nama_paket']) ?></td>
                                <td><?= htmlspecialchars($item['jenis_cuci']) ?></td>
                                <td><?= number_format($item['jumlah'], 1) . ' ' . htmlspecialchars($item['satuan']) ?></td>
                                <td>Rp<?= number_format($item['harga_per_unit'], 0, ',', '.') ?></td>
                                <td>Rp<?= number_format($item['sub_total'], 0, ',', '.') ?></td>
                                <td><?= htmlspecialchars($item['status_pesanan']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="summary-box">
                    <div class="summary-row">
                        <span class="label">Subtotal:</span>
                        <span class="value">Rp<?= number_format($transaksi_detail['subtotal'], 0, ',', '.') ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Diskon:</span>
                        <span class="value">Rp<?= number_format($transaksi_detail['diskon'], 0, ',', '.') ?></span>
                    </div>
                    <div class="summary-row total">
                        <span class="label">TOTAL AKHIR:</span>
                        <span class="value">Rp<?= number_format($transaksi_detail['total_akhir'], 0, ',', '.') ?></span>
                    </div>
                </div>

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
