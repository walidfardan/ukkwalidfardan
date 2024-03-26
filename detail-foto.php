<?php
include "koneksi.php";
session_start();

// Periksa apakah fotoid diterima melalui GET
if (!isset($_GET['fotoid'])) {
    header("location:index.php");
}

include "koneksi.php";

// Set 'fotoid' ke dalam session
$_SESSION['fotoid'] = $_GET['fotoid'];

// Mengambil 'fotoid' dari session
$fotoid = $_SESSION['fotoid'];

// Kueri SQL untuk mengambil informasi foto
$sql_foto = mysqli_query($conn, "SELECT * FROM foto WHERE fotoid= '$fotoid'");
$data_foto = mysqli_fetch_assoc($sql_foto);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Foto</title>
    <link rel="stylesheet" href="style/detailstyle.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- START NAVBAR -->
    <div class="container-navbar">
        <div class="kolom">
            <div class="logo">
                <img src="img/logo.jpg" width="90px">
            </div>
            <div class="links">
                <a href="index.php">Home</a>
                <a href="album.php">Album</a>
                <a href="foto.php">Create <i class="fa-solid fa-chevron-down"></i></a>
            </div>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search">
            </div>
            <div class="icons">
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-comment-dots"></i>
                <i class="fa-solid fa-circle-user"></i>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
    <!-- END NAVBAR -->



    <form action="tambah_komentar.php" method="post">
        <div class="container">
            <div class="detail-foto"><img src="gambar/<?= $data_foto['lokasifile'] ?>"></div>
            <div class="deskripsi">
                <div class="container-judul">
                    <h1>
                        &nbsp;
                        <?= $data_foto['judulfoto'] ?>
                    </h1>
                </div>
                <p>januari 2024</p>
                <div class="container-contianer">
                    <div class="container-deskripsi">
                        <h4>
                            <?= $data_foto['deskripsifoto'] ?>
                        </h4>
                    </div>
                    <p style="color: gray;">Komentar</p>
                    <div class="container-komen">
                        <?php
                        // Kueri SQL untuk mengambil komentar yang sesuai dengan 'fotoid' yang diberikan
                        $sql_komentar = mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid = '$fotoid'");
                        while ($data_komentar = mysqli_fetch_array($sql_komentar)) {
                            ?>
                        <ul>
                            <li style="font-weight: 500;">
                                <?= $data_komentar['namalengkap'] ?>
                            </li>
                            <li>
                                <?= $data_komentar['isikomentar'] ?>
                            </li>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="container-komentar">
                    <ul>
                        <li>
                            <input type="hidden" name="fotoid" value="<?= $fotoid ?>">
                            <input style="width:350px;" placeholder="Komentar..." type="text" name="isikomentar">
                        </li>
                        <li>
                            <input class="kirim" type="submit" value="Tambah">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</body>

<script>
    function toggleLove() {
        var btn = document.getElementById("btnLove");
        btn.classList.toggle("loved");
    }
</script>

</html>