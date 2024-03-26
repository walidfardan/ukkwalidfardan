<?php
session_start();
if (!isset ($_SESSION['userid'])) {
    header("location:register.php");
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

    <form action="tambah_foto.php" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <div class="con-header-foto">
                    <div class="con-text">
                        <h1>Insert Photo</h1>
                        <p>Tekan untuk lanjutkan</p>
                    </div>

                    <div class="con-submit">
                        <input class="submit" type="submit" value="Insert"></input>
                    </div>

                </div>
            </li>
            <div class="con-tambah">
                <div class="con-preview">
                    <div class="container-input">

                        <li>
                            <input class="file" type="file" name="lokasifile" id="fileInput">
                        </li>

                        <li class="preview">
                            <div id="imagePreview">
                                <i class="fa-solid fa-circle-arrow-up fa-2xl"></i>
                                <p>pilih file gambar yang ingin <br> anda terbitkan</p>
                            </div>
                        </li>

                    </div>
                </div>

                <div class="con-input">
                    <div class="con-input-deskripsi">
                        <li class="continer-input-judul">
                            <label>Nama Photo</label>
                            <input class="input-judul" id="input-judul" type="text" name="judulfoto">
                        </li>
                        <li class="continer-input-judul">
                            <label>Deskripsi</label>
                            <input id="input-judul" type="text" name="deskripsifoto">
                        </li>
                        <li class="dropdown">
                            <label>Album</label>
                            <label>
                                <select class="dropdown-content" name="albumid">
                                    <?php
                                    include "koneksi.php";
                                    $userid = $_SESSION['userid'];
                                    $sql = mysqli_query($conn, "select * from album where userid='$userid'");
                                    while ($data = mysqli_fetch_array($sql)) {
                                        ?>
                                        <option value="<?= $data['albumid'] ?>">
                                            <?= $data['namaalbum'] ?>
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
    </form>
    <br><br><br>
    <table border="1" cellpadding=5 cellspacing=0>
        <tr>
            <th>ID</th>
            <th>Lokasi File</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal Unggah</th>
            <th>Album</th>
            <th>Disukai</th>
            <th>Aksi</th>
        </tr>
        <?php
        include "koneksi.php";
        $nomor = 1;
        $userid = $_SESSION['userid'];
        $sql = mysqli_query($conn, "select * from foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
        while ($data = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td>
                    <?= $nomor; ?>
                </td>
                <td>
                    <?= $data['judulfoto'] ?>
                </td>
                <td>
                    <img src="gambar/<?= $data['lokasifile'] ?>" width="200px">
                </td>
                <td>
                    <?= $data['deskripsifoto'] ?>
                </td>
                <td>
                    <?= $data['tanggalunggah'] ?>
                </td>
                <td>
                    <?= $data['namaalbum'] ?>
                </td>
                <td>
                    <?php
                    $fotoid = $data['fotoid'];
                    $sql2 = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                    echo mysqli_num_rows($sql2);
                    ?>
                </td>
                <td>
                    <a href="hapus_foto.php?fotoid=<?= $data['fotoid'] ?>"><i class="fa-solid fa-trash"
                            style="color: #c70a0a;"></i></a>
                    <a href="edit_foto.php?fotoid=<?= $data['fotoid'] ?>"><i class="fa-solid fa-pen-to-square"
                            style="color: #2078bc;"></i></a>
                </td>
            </tr>
            <?= $nomor++; ?>
            <?php
        }
        ?>
    </table>

    </div>

    <script src="script/scriptfoto.js"></script>
    <!-- END FORM PENAMBAHAN FOTO -->

</body>

</html>