<?php
function checkRole($required_role) {
    // Check jika user tidak login
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        header("Location: ../login.php?pesan=gagal");
        exit;
    }

    // Check role
    if ($_SESSION['role'] != $required_role) {
        header("Location: ../login.php?pesan=akses_ditolak");
        exit;
    }
}
?>
