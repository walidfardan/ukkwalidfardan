<?php
session_start();
include "koneksi.php";

// Cek apakah pengguna sudah login atau belum
if (!isset ($_SESSION['userid'])) {
    $isLoggedIn = false;
} else {
    $isLoggedIn = true;
}

// Query awal untuk mengambil data foto dan user
$sql = "SELECT * FROM foto INNER JOIN user ON foto.userid = user.userid";

// Proses pencarian jika form pencarian dikirim
if (isset ($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $sql = "SELECT * FROM foto INNER JOIN user ON foto.userid = user.userid WHERE judulfoto LIKE '%$keyword%' OR deskripsifoto LIKE '%$keyword%'";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die ("Query error: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/indexstyle.css">
    <title>Pinterest - Dogs</title>

    <style>
    .focus {
        padding: 12px 9px;
        border-radius: 30px;
        background-color: black;
        color: white !important;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }


    .container {
        display: flex;
        flex-direction: column;
        top: 0;
        left: 0;
        position: fixed;
        width: 100%;
        background-color: white;
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
        padding: 8px 20px;
    }

    .search button {
        color: #555;
        cursor: pointer;
        border: none;
        background: #e4e4e4;
    }

    .search button:hover {
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
                <a href="index.php" class="focus">Home</a>
                <a href="album.php">Album</a>
                <a href="foto.php">Create <i class="fa-solid fa-chevron-down"></i></a>
            </div>
            <div class="search">
                <form action="index.php" method="post"> <!-- Ganti action ke index.php -->
                    <button type="submit" name="cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" placeholder="Search" name="keyword">
                </form>
            </div>

            <div class="icons">
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-comment-dots"></i>
                <div class="dropdown">
                    <i class="fa-solid fa-circle-user" id="user-dropdown"></i>
                    <div class="dropdown-content" id="dropdown-content">
                        <!-- Link untuk menu dropdown -->
                        <?php if (!$isLoggedIn): ?>
                            <a href="register.php">Register</a>
                            <a href="register.php">Login</a>
                        <?php else: ?>
                            <a href="logout.php">Logout</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END NAVBAR -->

    <div class="tab-content">
        <div id="tab-panel-1" class="tab-panel">
            <div id="container">
                <?php while ($data = mysqli_fetch_array($result)): ?>
                    <div class="col">
                        <div class="card">
                            <a href="detail-foto.php?fotoid=<?= $data['fotoid']; ?>"><img
                                    src="gambar/<?= $data['lokasifile']; ?>" width="200px"></a>
                            <div class="card-body"></div>
                        </div>
                        <div class="container-text-gambar">
                            <div class="container-deskripsi">
                                <h1 class="judul-gambar">
                                    <?= $data['judulfoto']; ?>
                                </h1>
                                <p class="username-gambar">
                                    <?= $data['namalengkap']; ?>
                                </p>
                            </div>
                            <div class="container-like">
                                <ul style="list-style:none;">
                                    <li>
                                        <?php
                                        $fotoid = $data['fotoid'];
                                        $sql2 = mysqli_query($conn, "SELECT * FROM likefoto where fotoid='$fotoid'");
                                        echo mysqli_num_rows($sql2);
                                        ?>
                                    </li>
                                    <li>
                                        <a href="like.php?fotoid=<?= $data['fotoid'] ?>"><i
                                                class="fa-regular fa-thumbs-up"></i></a>
                                    </li>
                            </div>
                            </ul>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- Tambahkan script untuk menutup dropdown saat mengklik di luar area dropdown -->
    <script>
        document.addEventListener("click", function (event) {
            var dropdownContent = document.getElementById("dropdown-content");
            var userDropdown = document.getElementById("user-dropdown");
            if (!event.target.matches('.fa-circle-user')) {
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                }
            }
        });
    </script>
</body>

</html>