import swal from 'sweetalert';
<?php
include "koneksi.php";
session_start();

$judulfoto = $_POST['judulfoto'];
$deskripsifoto = $_POST['deskripsifoto'];
$albumid = $_POST['albumid'];
$tanggalunggah = date("Y-m-d");
$userid = $_SESSION['userid'];

$rand = rand();
$ekstensi = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JFIF', 'jfif');
$filename = $_FILES['lokasifile']['name'];
$ukuran = $_FILES['lokasifile']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext, $ekstensi)) {
    header("location:foto.php");
} else {
    if ($ukuran < 5044070) {
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['lokasifile']['tmp_name'], 'gambar/' . $rand . '_' . $filename);
        mysqli_query($conn, "INSERT INTO foto VALUES(NULL,'$judulfoto','$deskripsifoto','$tanggalunggah','$xx','$albumid','$userid')");
        echo '
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
        swal({
            title: "Good job!",
            text: "Gambar berhasil di terbitkan, Lihat di beranda !",
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
            text: "Terjadi Kesalahan Coba masukkan file gambar atau melihat ketentuan",
            icon: "error",
            button: "OK",
        }).then(function() {
            window.location.href = "foto.php";
        });
        </script>
    ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            /* background-color: black; */
        }

        .container {
            position: fixed;
            background-color: red;
            z-index: -99;
        }

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

<body>
    <div class="gimmick"></div>
    <div class="container"></div>
</body>
</body>

</html>