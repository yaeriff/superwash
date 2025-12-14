<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:../login.php?pesan=belum_login");
    exit;
}

if($_SESSION['role'] != "owner"){
    header("location:../admin/index.php"); 
    exit;
}

include '../koneksi.php';

function formatTanggalIndo($tanggal) {
    if ($tanggal == null || $tanggal == '0000-00-00 00:00:00') {
        return "-";
    }
    
    $tgl_saja = date('Y-m-d', strtotime($tanggal));
    
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tgl_saja);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

$qKaryawan = mysqli_query($koneksi, "SELECT COUNT(*) as total, MAX(updated_at) as terakhir FROM karyawan");
$dKaryawan = mysqli_fetch_assoc($qKaryawan);
$jmlKaryawan = $dKaryawan['total'];
$tglKaryawan = formatTanggalIndo($dKaryawan['terakhir']);

$qBooking = mysqli_query($koneksi, "SELECT COUNT(*) as total, MAX(updated_at) as terakhir FROM pemesanan");
$dBooking = mysqli_fetch_assoc($qBooking);
$jmlBooking = $dBooking['total'];
$tglBooking = formatTanggalIndo($dBooking['terakhir']);

$qTransaksi = mysqli_query($koneksi, "SELECT COUNT(*) as total, MAX(updated_at) as terakhir FROM transaksi");
$dTransaksi = mysqli_fetch_assoc($qTransaksi);
$jmlTransaksi = $dTransaksi['total'];
$tglTransaksi = formatTanggalIndo($dTransaksi['terakhir']);

$stats = [
    [
        'title' => 'Jumlah Karyawan', 
        'count' => $jmlKaryawan, 
        'date'  => $tglKaryawan 
    ],
    [
        'title' => 'Total Booking',   
        'count' => $jmlBooking,  
        'date'  => $tglBooking 
    ],
    [
        'title' => 'Total Transaksi', 
        'count' => $jmlTransaksi,
        'date'  => $tglTransaksi 
    ]
];

// Label Bulan
$labels_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$data_transaksi = array_fill(0, 12, 0);
$tahun_ini = date('Y');
$queryGrafik = mysqli_query($koneksi, "
    SELECT MONTH(tanggal) as bulan, COUNT(*) as total 
    FROM transaksi 
    WHERE YEAR(tanggal) = '$tahun_ini' 
    GROUP BY MONTH(tanggal)
");

while($row = mysqli_fetch_assoc($queryGrafik)){
    $index = $row['bulan'] - 1;
    $data_transaksi[$index] = $row['total'];
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Wash Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">

</head>
<body>

<div class="container">
    
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-placeholder">
                <span><img src="../img/superwash_logo.png" alt=""></span>
            </div>
        </div>
        
        <?php
        $page = basename($_SERVER['PHP_SELF']);
        ?>

        <nav class="menu">
            <a href="index.php" class="<?= ($page == 'index.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Beranda
            </a>
            <a href="karyawan.php" class="<?= ($page == 'karyawan.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Karyawan
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
            
            <h2 class="page-title">Beranda Owner</h2>

            <div class="profile-dropdown">
                <div class="profile-trigger" id="profileTrigger">
                    <div class="profile-icon">
                        <?= substr($_SESSION['nama'], 0, 1) ?> </div>
                    <span class="profile-name">
                        Hi, <?= $_SESSION['nama'] ?> <i class="fa-solid fa-caret-down"></i>
                    </span>
                </div>

                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="profile.php">
                        <i class="fa-regular fa-user" style="margin-right: 8px;"></i> Profile
                    </a>
                    <a href="../logout.php" class="logout-link">
                        <i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i> Logout
                    </a>
                </div>
            </div>
        </header>

        <section class="hero">
            <div class="hero-content">
                <div class="hero-image">
                   <img src="../img/mesincuci.png" alt="Laundry Machine">
                </div>
                <div class="hero-text">
                    <h1>Percayakan<br>Cucianmu pada<br>Ahlinya <i></i></h1>
                </div>
            </div>
        </section>

        <section class="status-section">
            <h3>Informasi Layanan</h3>
            <div class="cards-container">
                <?php foreach($stats as $stat): ?>
                <div class="card">
                    <small><?= $stat['title'] ?></small>
                    
                    <span class="date"><?= $stat['date'] ?></span>
                    
                    <div class="count"><?= $stat['count'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <h3 id="judultable">Grafik Jumlah Transaksi Per Bulan</h3>
        <section class="table-section" id="grafik">
            
            <div style="position: relative; height:400px; width:100%; padding: 20px;">
                <canvas id="myBarChart"></canvas>
            </div>
        </section>

        <footer class="footer">
            <p><i class="fa-solid fa-save"></i> Kelompok 4 2025</p>
        </footer>

    </main>
</div>

<script>
    const dataGrafik = {
        labels: <?php echo json_encode($labels_bulan); ?>,
        values: <?php echo json_encode($data_transaksi); ?>
    };
</script>

<script src="../js/skrip.js?t=<?php echo time(); ?>"></script>
</body>
</html>
