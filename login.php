<?php
session_start();
?>
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
    
    <style>
        .login-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
            background-color: #ffeeb0;
            font-family: Poppins, sans-serif;
            overflow: hidden;
            position: relative;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url(img/background-login.png);
            background-size: cover;
            background-position: center;
            opacity: 0.7;
            z-index: 0;
        }

        .login-left, .login-right {
            position: relative;
            z-index: 1;
        }

        .login-left {
            flex: 1.5;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 20px;
        }

        .illustration-wrapper {
            position: relative;
            z-index: 2;
            max-width: 500px;
        }

        .hanger-icon {
            font-size: 60px;
            color: #1a253a;
            position: absolute;
            top: -60px;
            left: -40px;
            transform: rotate(-15deg);
        }

        .illustration-wrapper h1 {
            font-size: 42px;
            color: #1a253a;
            line-height: 1.2;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .illustration-wrapper p {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .login-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            background-color: #1a253a;
            padding: 30px 25px;
            border-radius: 15px;
            width: 100%;
            max-width: 350px;
            color: white;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }

        .logo-placeholder {
            font-weight: bold;
            color: #ffd700;
            line-height: 1;
            font-size: 16px;
        }

        .login-card h2 {
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #ccc;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: none;
            border-radius: 8px;
            background-color: #95a5a6;
            color: #1a253a;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus {
            background-color: #fff;
        }

        .password-toggle-icon {
            position: absolute;
            right: 15px;
            top: 42px;
            cursor: pointer;
            color: #777;
            font-size: 16px;
            z-index: 10;
        }

        .password-toggle-icon:hover {
            color: #333;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #e67e22;
            border: none;
            border-radius: 30px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background-color: #d35400;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }

        .alert-error {
            background-color: #ffecec;
            color: red;
        }

        .alert-success {
            background-color: #e1ffe1;
            color: green;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                overflow-y: auto;
            }

            .login-left {
                display: none;
            }

            .login-right {
                flex: 1;
                padding: 20px;
                background-color: #ffeeb0;
            }
        }
    </style>
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
                        <img src="img/superwash_logo.png" alt="Logo" style="width: 80px;">
                    </div>
                </div>

                <h2>Masuk Akun</h2>

                <?php 
                if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "gagal"){
                        echo "<div class='alert alert-error'>Username atau Password salah!</div>";
                    } else if($_GET['pesan'] == "logout"){
                        echo "<div class='alert alert-success'>Anda telah berhasil logout</div>";
                    } else if($_GET['pesan'] == "belum_login"){
                        echo "<div class='alert alert-warning'>Silahkan login terlebih dahulu</div>";
                    }
                }
                ?>

                <form action="cek_login.php" method="POST"> 
                    <div class="form-group">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label for="password">Sandi</label>
                        <input type="password" id="password" name="password" placeholder="Password" required style="padding-right: 40px;">
                        <span id="togglePassword" class="password-toggle-icon">
                            <i class="fa-solid fa-eye" ></i>
                        </span>
                    </div>
                    <button type="submit" class="btn-submit">Masuk</button>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordInput = document.querySelector("#password");
        const icon = togglePassword.querySelector("i");

        togglePassword.addEventListener("click", function () {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            
            if (type === "text") {
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>

</body>
</html>
