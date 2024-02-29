<?php
include "koneksi.php";
session_start();

if (isset($_GET['fotoid'])) {
    $fotoid = $_GET['fotoid'];
} else {
    // Jika foto tidak disediakan, redirect ke foto.php
    header("location:foto.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] ==='POST') {
    // Check if the confirmation parameter is set
    if (isset($_POST['confirmDelete']) && $_POST['confirmDelete'] === 'yes') {
        // Pengguna mengkonfirmasi penghapusan, lanjutkan dengan penghapusan
        $sql = mysql_query($conn, "DELETE FROM foto WHERE fotoid='$fotoid'");
        header("location:foto.php");
        exit();        
    }
}

?>
<?php
// Skrip Javascript untuk mengkonfirmasi penghapusan menggunakan alert
echo '<script>
    var result = confirm("Apakah kamu yakin ingin menghapus foto ini?");
    if (result) {
        // User confirmed, submit the form 
        window.location.href = "proses_hapus_foto.php?fotoid=' . $fotoid .'";
    } else {
        // User canceled the delection, redirect to foto.php 
        window.location.href = "foto.php";
    }
</script>';
?>