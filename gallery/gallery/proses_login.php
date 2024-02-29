<?php
include "koneksi.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($sql);

if ($cek == 1) {
    while ($data = mysqli_fetch_array($sql)) {
        $_SESSION['userid'] = $data['userid'];
        $_SESSION['namalengkap'] = $data['namalengkap'];
    }
    echo "<script> 
        alert('Login berhasil');
        location.href='index.php';
        </script>";
} else {
    $usernameCheck = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    $passwordCheck = mysqli_query($conn, "SELECT * FROM user WHERE password='$password'");
    
    $isUsernameCorrect = mysqli_num_rows($usernameCheck) > 0;
    $isPasswordCorrect = mysqli_num_rows($passwordCheck) > 0;

    if (!$isUsernameCorrect && !$isPasswordCorrect) {
        echo "<script> 
            alert('Username dan password salah');
            window.location.href='login.php';
            </script>";
    } elseif (!$isUsernameCorrect) {
        echo "<script> 
            alert('Username salah');
            window.location.href='login.php';
            </script>";
    } elseif (!$isPasswordCorrect) {
        echo "<script> 
            alert('Password salah');
            window.location.href='login.php';
            </script>";
    }
}
?>
