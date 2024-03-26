<?php
include 'koneksi.php';
$kontak = mysqli_query($conn, "SELECT userid, username, namalengkap FROM user WHERE userid");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM foto WHERE fotoid = '" . $_GET['fotoid'] . "' ");
$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">WEB GALERI FOTO</a></h1>
            <ul>
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="registrasi.php">Registrasi</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

    <!-- product detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                    <img src="foto/<?php echo $p->image ?>" width="100%" />
                </div>
                <div class="col-2">
                    <h3>
                        <?php echo $p->judulfoto ?><br />Kategori :
                        <?php echo $p->albumid ?>
                    </h3>
                    <h4>Nama User :
                        <?php echo $p->namalengkap ?><br />
                        Upload Pada Tanggal :
                        <?php echo $p->tanggalunggah ?>
                    </h4>
                    <p>Deskripsi :<br />
                        <?php echo $p->deskripsifoto ?>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
        </div>
    </footer>
</body>

</html>