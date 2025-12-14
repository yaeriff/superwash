<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Super Wash</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="css/style.css?t=<?php echo time(); ?>">
</head>
<body>

    <div class="login-container">
        
        <div class="login-left">
            <div class="illustration-wrapper">
                <i class="fa-solid fa-shirt hanger-icon"></i>
                <h1>Percayakan Cucianmu<br>pada Ahlinya</h1>
                <p>Proses cepat, aman, dan terpercaya</p>    
            </div>
        </div>

        <div class="login-right">
            <div class="login-card">
                <div class="login-logo">
                    <div class="logo-placeholder">
                         <span><img src="img/superwash_logo.png" alt="" style="width: 80px;"></span>
                    </div>
                </div>

                <h2>Masuk Akun</h2>

                <?php 
                if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "gagal"){
                        echo "<div style='background: #ffecec; color: red; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center;'>Username atau Password salah!</div>";
                    } else if($_GET['pesan'] == "logout"){
                        echo "<div style='background: #e1ffe1; color: green; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center;'>Anda telah berhasil logout</div>";
                    } else if($_GET['pesan'] == "belum_login"){
                        echo "<div style='background: #fff3cd; color: #856404; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center;'>Silahkan login terlebih dahulu</div>";
                    }
                }
                ?>

                <form action="cek_login.php" method="POST"> 
                    <div class="form-group">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" id="username" name="username" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Sandi</label>
                        <input type="password" id="password" name="password" placeholder="" required>
                    </div>

                    <button type="submit" class="btn-submit">Masuk</button>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>