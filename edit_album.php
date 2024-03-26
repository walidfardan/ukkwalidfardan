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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/albumstyle.css">
    <title>Halaman Album</title>
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
</head>

<body>
    <!-- START NAVBAR -->
    <div class="container">
        <div class="kolom">
            <div class="logo">
                <i class="fa-brands fa-pinterest"></i>
            </div>
            <div class="links">
                <a href="index.php">Home</a>
                <a href="album.php" class="focus">Album</a>
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
    <br><br>
    <!-- END NAVBAR -->
    <p class="text-selamatdatang">Selamat datang <b>
            <?= $_SESSION['namalengkap'] ?>
        </b></p>

    <!-- <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="album.php">Album</a></li>
        <li><a href="foto.php">Foto</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul> -->

    <div class="container-all">
        <form action="update_album.php" method="post">
            <?php
            include "koneksi.php";
            $albumid = $_GET['albumid'];
            $sql = mysqli_query($conn, "SELECT * FROM album where albumid='$albumid'");
            while ($data = mysqli_fetch_array($sql)) {
                ?>
                <input type="text" name="albumid" value="<?= $data['albumid'] ?>" hidden>
                <div class="container-foto">
                    <ul>
                        <li>
                            <label for="namaalbum">Nama Album</label>
                            <input class="inputalbum" type="text" id="namaalbum" name="namaalbum"
                                value="<?= $data['namaalbum'] ?>" required>
                        </li>
                        <li>
                            <label for="namaalbum">Deskripsi</label>
                            <input class="inputalbum" type="text" id="deskripsi" name="deskripsi"
                                value="<?= $data['deskripsi'] ?>" required>
                        </li>
                        <li class="container-submit">
                            <input style="visibility:hidden;" type="button" id="reset-btn" value="Reset ulang"></input>
                            <input type="submit" value="Ubah" class="simpan">
                        </li>
                    </ul>
                </div>
                <?php
            }
            ?>
        </form>
    </div>
</body>

</html>