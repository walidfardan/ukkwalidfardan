<?php
session_start();
if (!isset ($_SESSION['userid'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto</title>
    <link rel="stylesheet" href="style/stylefoto.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .focus {
        padding: 12px 9px;
        border-radius: 30px;
        background-color: black;
        color: white !important;
    }

    .container {
        display: flex;
        flex-direction: column;
        top: 0;
        left: 0;
        position: absolute;
        width: 100%;
    }

    .kolom {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        height: 70px;
        width: 100%;
        box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.2);
    }

    .logo i {
        font-size: 32px;
        padding: 33px;
    }

    .links {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .links a {
        color: #111;
        text-decoration: none;
        margin: 0 10px;
        font-weight: 500;
        letter-spacing: 1px;
    }

    .search {
        width: 800px;
        height: 40px;
        background: #e4e4e4;
        border-radius: 80px;
        padding: 0 20px;
    }

    .search i {
        color: #555;
        cursor: pointer;
    }

    .search i:hover {
        color: #3c3c3c;
    }

    .search input {
        border: none;
        background: transparent;
        width: 80%;
        height: 100%;
        outline: none;
        padding: 0 10px;
        font-size: 16px;
        margin: 0 10px;
        font-weight: 200;
    }

    .icons {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icons i {
        font-size: 36-x;
        color: #333;
        margin: 0 15px;
        cursor: pointer;
    }
</style>

<body>
    <!-- START NAVBAR -->
    <div class="container">
        <div class="kolom">
            <div class="logo">
                <img src="img/logo.jpg" width="90px">
            </div>
            <div class="links">
                <a href="index.php">Home</a>
                <a href="album.php">Album</a>
                <a href="foto.php" class="focus">Create <i class="fa-solid fa-chevron-down"></i></a>
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

    <!-- START FORM PENAMBAHAN FOTO -->

    <form action="update_foto.php" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <div class="con-header-foto">
                    <div class="con-text">
                        <h1>Update Photo</h1>
                        <p>Tekan untuk lanjutkan</p>
                    </div>

                    <div class="con-submit">
                        <input class="submit" type="submit" value="Update"></input>
                    </div>

                </div>
            </li>
            <?php
            include "koneksi.php";
            // Periksa apakah 'fotoid' tersedia dalam URL
            if (isset ($_GET['fotoid'])) {
                $fotoid = $_GET['fotoid'];
                $sql = mysqli_query($conn, "select * from foto where fotoid='$fotoid'");
                while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
                    <div class="con-tambah">
                        <div class="con-preview">
                            <div class="container-input">

                                <li>
                                    <input class="file" type="file" name="lokasifile" id="fileInput">
                                </li>

                                <li class="preview">
                                    <div id="imagePreview">
                                        <i class="fa-solid fa-circle-arrow-up fa-2xl"></i>
                                        <p>pilih file gambar yang ingin <br> anda Perbarui</p>
                                    </div>
                                </li>

                            </div>
                        </div>

                        <div class="con-input">
                            <div class="con-input-deskripsi">
                                <li class="continer-input-judul">
                                    <label>Nama Photo</label>
                                    <input class="input-judul" id="input-judul" type="text" name="judulfoto"
                                        value="<?= $data['judulfoto'] ?>">
                                </li>
                                <li class="continer-input-judul">
                                    <label>Deskripsi</label>
                                    <input id="input-judul" type="text" name="deskripsifoto"
                                        value="<?= $data['deskripsifoto'] ?>">
                                </li>
                                <li class="dropdown">
                                    <label>Album</label>
                                    <label>
                                        <select name="albumid" class="dropdown-content">
                                            <?php
                                            $userid = $_SESSION['userid'];
                                            $sql2 = mysqli_query($conn, "SELECT * FROM album where userid='$userid'");
                                            while ($data2 = mysqli_fetch_array($sql2)) {
                                                ?>
                                                <option value="<?= $data2['albumid'] ?>" <?php if ($data2['albumid'] == $data['albumid']) {
                                                      echo 'selected';
                                                  } ?>>
                                                    <?= $data2['namaalbum'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </li>
                            </div>
                        </div>
                        </li>
                        </li>
                    </div>
                </ul>
                <?php
                }
            } else {
                echo "Fotoid tidak ditemukan.";
            }
            ?>
    </form>
    </div>

    <script src="script/scriptfoto.js"></script>
    <!-- END FORM PENAMBAHAN FOTO -->

</body>

</html>