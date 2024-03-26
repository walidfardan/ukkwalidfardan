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
            <img src="img/logo.jpg" width="90px">
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
        <form action="tambah_album.php" method="post">
            <div class="container-foto">
                <ul>
                    <li>
                        <label for="namaalbum">Nama Album</label>
                        <input class="inputalbum" type="text" id="namaalbum" name="namaalbum" required>
                    </li>
                    <li>
                        <label for="namaalbum">Deskripsi</label>
                        <input class="inputalbum" type="text" id="deskripsi" name="deskripsi" required>
                    </li>
                    <li class="container-submit">
                        <input type="button" id="reset-btn" value="Reset ulang"></input>
                        <input type="submit" value="Tambah" class="simpan">
                    </li>
                </ul>
            </div>
        </form>

        <table border="1" cellpadding=5 cellspacing=0>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Tanggal dibuat</th>
                <th>Aksi</th>
            </tr>
            <?php
            include "koneksi.php";
            $no = 1;
            $userid = $_SESSION['userid'];
            $sql = mysqli_query($conn, "SELECT * FROM album where userid='$userid'");
            while ($data = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <td class="center">
                        <?= $no ?>
                    </td>
                    <td>
                        <?= $data['namaalbum'] ?>
                    </td>
                    <td>
                        <?= $data['deskripsi'] ?>
                    </td>
                    <td class="center">
                        <?= $data['tanggaldibuat'] ?>
                    </td>
                    <td class="center">
                        <a href="hapus_album.php?albumid=<?= $data['albumid'] ?>"><i class="fa-solid fa-trash"></i></a>
                        <a href="edit_album.php?albumid=<?= $data['albumid'] ?>"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
                <?php $no++; ?>
                <?php
            }
            ?>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const resetBtn = document.getElementById("reset-btn");
            resetBtn.addEventListener("click", function () {
                document.getElementById("namaalbum").value = "";
                document.getElementById("deskripsi").value = "";
            });
        });

    </script>
</body>

</html>