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

$sql = "SELECT * FROM pesanan";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afi Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/daftarPesanan.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Reddit+Mono&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="header">
        <div class="navbar">
            <div class="brand">Afi.</div>
            <?php
            if (isset($_SESSION['login-username'])) {
                echo '<p style="color: white; margin-right:20px;"> Halo ' . $_SESSION['login-username'] . ' !</p>';
            }

            ?>
        </div>
        <div class="gambar">
            <div class="herotext">
                <h1>SOLUSI RENTAL MOBIL HEMAT</h1>
                <p>Apakah Anda mencari pengalaman berkendara yang nyaman, aman, dan bebas repot? Afi Rental hadir untuk memenuhi semua kebutuhan transportasi Anda. Kami menyediakan berbagai pilihan mobil yang sesuai dengan berbagai kebutuhan, mulai dari perjalanan bisnis, liburan keluarga, hingga acara khusus.</p>
            </div>
            <div class="img">
                <img src="../assets/car.jpg" alt="">
            </div>
        </div>
    </div>

    <div class="content">




        <div class="container">
            <a href="../index.php" class="btn">Daftar Mobil</a>
            <a href="#" class="btn">Riwayat Pesanan</a>

            <div class="daftarmbl" id="mobilDaftar">


                <div class="row">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $row['merk']; ?></h4>
                                    <div class="text-container">
                                        <table>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>:</td>
                                                <td><?php echo $row['namalengkap']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>

                                                <td><?php echo $row['alamat']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Sewa</td>
                                                <td>:</td>
                                                <td><?php echo $row['tanggal']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Lama Sewa</td>
                                                <td>:</td>
                                                <td><?php echo $row['lamapinjam']; ?> Hari</td>
                                            </tr>
                                            <tr>
                                                <td>Transmisi</td>
                                                <td>:</td>
                                                <td><?php echo $row['transmisi']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bahan Bakar</td>
                                                <td>:</td>
                                                <td><?php echo $row['bahanbakar']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Supir</td>
                                                <td>:</td>
                                                <td><?php echo $row['supir']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Bayar</td>
                                                <td>:</td>
                                                <td>Rp. <?php echo $row['harga']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status Pesanan</td>
                                                <td>:</td>
                                                <td><?php if ($row['stts'] === "Pesanan Diterima") { 
                                                echo $row['stts'].'( Menunggu Pembayaran )';  
                                                }
                                                else if ($row['stts'] === "Pembayaran Berhasil"){
                                                    echo  $row['stts']. ' Mobil akan segera diantar ke alamat mu!';
                                                }
                                                else{
                                                echo $row['stts'];  

                                                } ?>
                                                    
                                                    </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <?php if ($row['stts'] === "Pesanan Diterima") {
                                        echo '<a href="../bayar/bayar.php?id=' . $row['id'] . '" class="pesan">Lanjutkan Pembayaran</a>';
                                    }else if ($row['stts'] === "Pembayaran Berhasil"){
                                        echo '<a href="../pengembalian/pengembalian.php?id=' . $row['id'] . '" class="pesan">Ajukan Pengembalian</a>';

                                    }

                                    ?>



                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="pesanan">

            </div>
        </div>
    </div>

    <div class="footer">
        <p>Solusi atas semua kebutuhan transportasi dalam perjalanan wisata atupun bisnis anda di Lombok</p>
        <?php
        if (isset($_SESSION['login-username'])) {
            echo '<a href="../logout.php" class="login" id="logout">Logout</a>';
        } else {
            echo '<a href="login.php" class="login">Log in</a>';
        }
        ?>
    </div>
    <script src="script/logout.js"></script>
    <script src="admin.js"></script>
    <script type="text/javascript">
        function validateLogin() {
            <?php if (isset($_SESSION['login-username'])) { ?>
                window.location.href = 'index.php';
            <?php } else { ?>
                alert('Silakan login terlebih dahulu.');
            <?php } ?>
        }
    </script>
</body>

</html>