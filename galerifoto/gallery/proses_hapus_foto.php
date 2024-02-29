<?php
include "koneksi.php";
session_start();

// Menggunakan parameter terikat untuk mencegah SQL injection
if (isset($_GET['fotoid'])) {
    $fotoid = $_GET['fotoid'];
    $sql = mysqli_prepare($conn, "DELETE FROM foto WHERE fotoid = ?");
    mysqli_stmt_bind_param($sql, "s", $fotoid);
    mysqli_stmt_execute($sql);

    // Periksa apakah ada baris yang terpengaruh (foto dihapus)
    if (mysqli_stmt_affected_rows($sql) > 0){
        $_SESSION['succes_massage'] = "foto berhasil dihapus";
    } else {
        $_SESSION['error_massage'] = "Gagal menghapus foto. foto tidak ditemukan atau terjadi kesalahan.";
    }

    mysqli_stmt_close($sql);
} else {
    $_SESSION['error_massage'] = "Gagal menghapus foto. parameter fotoid tidak valid.";
}

header("location:foto.php");