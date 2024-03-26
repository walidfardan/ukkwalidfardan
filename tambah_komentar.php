<?php
include "koneksi.php";
session_start();

if (!isset ($_SESSION['userid'])) {
    echo "Error: Anda harus login untuk memberikan komentar.";
    exit;
}

if (!isset ($_POST['fotoid']) || empty ($_POST['fotoid'])) {
    echo "Error: Fotoid tidak diterima.";
    exit;
}

$fotoid = $_POST['fotoid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkomentar = date("Y-m-d");
$userid = $_SESSION['userid'];

$sql = mysqli_query($conn, "INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) VALUES ('$fotoid', '$userid', '$isikomentar', '$tanggalkomentar')");

if ($sql) {
    header("location:detail-foto.php?fotoid=" . $fotoid);
} else {
    echo "Error: Terjadi kesalahan dalam menambahkan komentar.";
}
?>