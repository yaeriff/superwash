<?php
$data_karyawan = [
    ['id' => 'KRY001', 'nama' => 'Ahmad Santoso', 'nohandphone' => '082336428792', 'alamat' => 'solo', 'username' => 'ahmda', 'ps' => 'aaa123'],
    ['id' => 'KRY002', 'nama' => 'Siti Aminah', 'nohandphone' => '082336428792', 'alamat' => 'semarang', 'username' => 'sisi', 'ps' => 'siti123' ],
    ['id' => 'KRY003', 'nama' => 'Budi Hartono', 'nohandphone' => '082336428792', 'alamat' => 'magelang', 'username' => 'budbud', 'ps' => 'bufu123'],
    ['id' => 'KRY004', 'nama' => 'Dewi Lestari', 'nohandphone' => '082336428792', 'alamat' => 'salatiga', 'username' => 'dwi', 'ps' => '123123'],
    ['id' => 'KRY005', 'nama' => 'Eko Prasetyo', 'nohandphone' => '082336428792', 'alamat' => 'ambarawa', 'username' => 'eko', 'ps' => 'ekontol'],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan - Super Wash</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">
    
    <style>
        table td:last-child {
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 5px;
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
        
        <?php $page = basename($_SERVER['PHP_SELF']); ?>

        <nav class="menu">
            <a href="index.php" class="<?= ($page == 'index.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Beranda
            </a>
            <a href="karyawan.php" class="<?= ($page == 'karyawan.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i> Karyawan
            </a>
            <a href="transaksi.php" class="<?= ($page == 'transaksi.php') ? 'active' : '' ?>">
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
            <h2 class="page-title">List Karyawan</h2>
        </header>

        <section class="table-section">
            
            <div class="table-responsive">
                <table id="tabelKaryawan" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Karyawan</th>
                            <th>Nama</th>
                            <th>No Handphone</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Kata Sandi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_karyawan as $karyawan): ?>
                        <tr>
                            <td><?= $karyawan['id'] ?></td>
                            <td><?= $karyawan['nama'] ?></td>
                            <td><?= $karyawan['nohandphone'] ?></td>
                            <td><?= $karyawan['alamat'] ?></td>
                            <td><?= $karyawan['username'] ?></td>
                            <td><?= $karyawan['ps'] ?></td>
                            <td>
                                
                                <button class="btn-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                
                                <button class="btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button class="btn-add-large"><i class="fa-solid fa-plus"></i> Tambah</button>
        </section>

        <footer class="footer">
            <p><i class="fa-solid fa-save"></i> Kelompok 4 2025</p>
        </footer>

    </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="../js/skrip.js?t=<?php echo time(); ?>"></script>

<script>
    $(document).ready(function () {
        $('#tabelKaryawan').DataTable({
            columnDefs: [
                { orderable: false, targets: 6 }
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Lanjut",
                    previous: "Kembali"
                }
            }
        });
    });
</script>

</body>
</html>