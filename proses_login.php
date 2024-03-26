import swal from 'sweetalert';
<?php
include "koneksi.php";
session_start();

// Membuat variabel penanda untuk menandai apakah program sudah dijalankan
$program_jalan = false;

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($conn, "select * from user where username='$username' and password='$password'");

$cek = mysqli_num_rows($sql);

if ($cek == 1) {
    while ($data = mysqli_fetch_array($sql)) {
        $_SESSION['userid'] = $data['userid'];
        $_SESSION['namalengkap'] = $data['namalengkap'];
    }
    // Mengubah nilai variabel penanda menjadi true karena program sudah dijalankan
    $program_jalan = true;
    echo '
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
           swal({
  title: "Good job!",
  text: "Log In berhasil, Selamat datang!",
  icon: "success",
            }).then(function() {
                window.location.href = "index.php";
            });
            </script>
        ';
} else {
    echo '
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
            swal({
                title: "Kesalahan!",
                text: "ID dan Username yang Anda masukkan salah",
                icon: "error",
                button: "OK",
            }).then(function() {
                window.location.href = "register.php";
            });
            </script>
        ';
}

// Memeriksa apakah variabel penanda sudah bernilai true sebelum menjalankan program berikutnya
if ($program_jalan) {
    // Jalankan program berikutnya di sini
    // Misalnya, header("location: halaman_berikutnya.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .gimmick {
            width: 100%;
            height: 6rem;
            background-color: white;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<div class="gimmick"></div>


<body>

</body>

</html>