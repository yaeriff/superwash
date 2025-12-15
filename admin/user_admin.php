<?php
session_start();
include '../backend/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php?pesan=gagal");
    exit;
}

$data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE role IN ('owner', 'karyawan') ORDER BY user_id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Super Wash</title>
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background-color: #1a253a;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e67e22;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-bottom: 15px;
        }
        
        .btn:hover {
            background-color: #d35400;
        }
        
        .btn-danger {
            background-color: #e74c3c;
            padding: 5px 10px;
            font-size: 12px;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        .btn-edit {
            background-color: #3498db;
            padding: 5px 10px;
            font-size: 12px;
        }
        
        .btn-edit:hover {
            background-color: #2980b9;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table th {
            background-color: #1a253a;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .table tr:hover {
            background-color: #f9f9f9;
        }
        
        .alert {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .logout-btn {
            background-color: #e67e22;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Kelola User (Owner & Karyawan)</h1>
                <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['nama']); ?></p>
            </div>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="alert">
                Berhasil disimpan!
            </div>
        <?php endif; ?>
        
        <a href="adduser.php" class="btn"><i class="fas fa-plus"></i> Tambah User</a>
        <a href="index.php" class="btn" style="background-color: #95a5a6;"><i class="fas fa-arrow-left"></i> Kembali</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>No. Telepon</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($data_user)): ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['no_tlpn']); ?></td>
                        <td>
                            <span style="background-color: <?php echo ($row['role'] == 'owner') ? '#3498db' : '#e67e22'; ?>; 
                                         color: white; padding: 5px 10px; border-radius: 3px;">
                                <?php echo ucfirst($row['role']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="edituser.php?id=<?php echo $row['user_id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="../backend/process/hapus_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
