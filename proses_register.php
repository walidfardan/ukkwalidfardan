import swal from 'sweetalert';
<?php
include "koneksi.php";

// $program_jalan = false;

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

$sql = mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password', '$email', '$namalengkap', '$alamat')");

if ($sql == 1) {
    // $program_jalan = true;
    echo '
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal({
        title: "Good job!",
        text: "Kamu berhasil Membuat Akun, SILAHKAN LOGIN !",
        icon: "success",
    }).then(function() {
        window.location.href = "register.php";
    });
    </script>
    ';
} else {
    echo '
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal({
        title: "Kesalahan!",
        text: "Terjadi Kesalahan Coba dengan Data yang Unik dan berbeda dari sebelumnya",
        icon: "error",
        button: "OK",
    }).then(function() {
        window.location.href = "register.php";
    });
    </script>
';
}

?>
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