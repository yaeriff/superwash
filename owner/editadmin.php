<?php
session_start();
include '../backend/koneksi.php';

if ($_SESSION['role'] != 'owner') {
    header("Location: ../login.php?pesan=gagal");
    exit;
}

$user_id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$user_id' AND role='admin'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin - Super Wash</title>
    <link rel="stylesheet" href="../css/style.css?t=<?php echo time(); ?>">
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            color: #1a253a;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #e67e22;
            box-shadow: 0 0 5px rgba(230, 126, 34, 0.3);
        }
        
        .btn-group {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .btn {
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }
        
        .btn-submit {
            background-color: #e67e22;
            color: white;
        }
        
        .btn-submit:hover {
            background-color: #d35400;
        }
        
        .btn-cancel {
            background-color: #95a5a6;
            color: white;
        }
        
        .btn-cancel:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Admin</h1>
        
        <form action="proses_edit_admin.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
            
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($data['password']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="no_tlpn">No. Telepon</label>
                <input type="text" id="no_tlpn" name="no_tlpn" value="<?php echo htmlspecialchars($data['no_tlpn']); ?>" required>
            </div>
            
            <div class="btn-group">
                <button type="submit" class="btn btn-submit">Simpan</button>
                <a href="user_admin.php" class="btn btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
