<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalmobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM mobil";
$result = $conn->query($sql);


$sql_pesanan = "SELECT id FROM pesanan";
$result_pesanan = $conn->query($sql_pesanan);
$pesanan_ids = array();
if ($result_pesanan->num_rows > 0) {
    while ($row = $result_pesanan->fetch_assoc()) {
        $pesanan_ids[] = $row['id'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nge-Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Reddit+Mono&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

</head>

<body>

    <div class="header">
        <div class="navbar">
            <div class="brand">Nge-Bandung.</div>
            <?php
            if (isset($_SESSION['login-username'])) {
                echo '<p style="color: white; margin-right:20px;"> Halo ' . $_SESSION['login-username'] . ' !</p>';
            }

            ?>
        </div>
        <div class="gambar">
            <div class="herotext">
                <h1>SOLUSI RENTAL MOBIL HEMAT</h1>
                <p>Apakah Anda mencari pengalaman berkendara yang nyaman, aman, dan bebas repot? Nge-Bandung hadir untuk memenuhi semua kebutuhan transportasi Anda. Kami menyediakan berbagai pilihan mobil yang sesuai dengan berbagai kebutuhan, mulai dari perjalanan bisnis, liburan keluarga, hingga acara khusus.</p>
            </div>
            <div class="img">
                <img src="assets/car.jpg" alt="">
            </div>
        </div>
    </div>

    <div class="content">
        <div class="carimobil">
            <form action="">
                <table>
                    <tr>
                        <td>
                            <select id="jenis" name="jenis">
                                <option value="Matic">Matic</option>
                                <option value="Manual">Manual</option>
                            </select>
                        </td>
                        <td><select id="driver" name="driver">
                                <option value="Bensin">Bensin</option>
                                <option value="Diesel">Diesel</option>
                            </select></td>
                        <td>
                            <input type="date">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center"><input type="button" value="Cari" onclick="cekLogin()"></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="carousel">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-theme="dark">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/inovablack.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/b.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/c.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/d.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/pajero.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/a.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="container">
            <a href="index.php" class="btn">Daftar Mobil</a>


            <a href="pesanan/daftarPesanan.php" class="btn" onclick="cekLogin()">Riwayat Pesanan</a>

            <div class="daftarmbl" id="mobilDaftar">


                <div class="row">
                    <?php while ($row = $result->fetch_assoc()) {
                        $is_booked = in_array($row['id'], $pesanan_ids);
                    ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="admin/<?php echo $row['gambar']; ?>" class="card-img-top" alt="Gambar Mobil">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['merk']; ?></h5>
                                    <div class="text-container">
                                        <p class="text">Transmisi: <?php echo $row['transmisi']; ?></p>
                                        <p class="text">Harga: Rp.<?php echo $row['harga']; ?> / hari</p>
                                        <p class="text">Bahan Bakar: <?php echo $row['bahanbakar']; ?></p>
                                    </div>
                                    <?php if ($is_booked) { ?>
                                        <a href="#" class="pesan">Tidak Tersedia</a>
                                    <?php } else { ?>
                                        <a href="pesanan/formPesan.php?id=<?php echo $row['id']; ?>" class="pesan">Pesan Sekarang</a>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Solusi atas semua kebutuhan transportasi dalam perjalanan wisata atupun bisnis anda di Bandung</p>
        <?php
        if (isset($_SESSION['login-username'])) {
            echo '<a href="logout.php" class="login" id="logout">Logout</a>';
        } else {
            echo '<a href="login.php" class="login">Log in</a>';
        }
        ?>
    </div>

    <script src="script/logout.js"></script>
    <script src="admin.js"></script>

    <script type="text/javascript">
        function cekLogin() {
            var isLoggedIn = <?php echo isset($_SESSION['login-username']) ? 'true' : 'false'; ?>;

            if (!isLoggedIn) {
                alert("Silahkan login terlebih dahulu!");
                event.preventDefault();
            }
        }
        var pesanLinks = document.querySelectorAll('.pesan');
        pesanLinks.forEach(function(link) {
            link.addEventListener('click', cekLogin);
        });
    </script>
</body>

</html>