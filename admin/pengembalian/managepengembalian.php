<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalmobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pengembalian";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>
    <div class="header">
        <h1>Welcome Admin!</h1>
        <a href="../../logout.php" class="logout">Log out</a>
    </div>
    <div class="content">
        <div class="nav">
            <div class="mobil">
                <a href="../admin.php">
                    <p>Daftar Mobil</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="../pesanan/managepesanan.php">
                    <p>Daftar & Status Pesanan</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="#">
                    <p>Status Pembayaran</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="../pengguna/managepengguna.php">
                    <p>Akun Pengguna</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="#" >
                    <p>Pengembalian</p>
                </a>
            </div>
        </div>
        <div class="opr">
            <div class="tabel" id="mobilTable">
                <table>
                    <h3 style="padding-block:10px;"><b>Daftar Pembayaran</b></h3>
                    <thead>
                        <tr>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Konfirmasi Pengembalian</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['alamat']; ?></td>
                                <td><?php echo $row['telepon']; ?></td>

                                <td>
                                    <a href="konfirmasi.php?id=<?php echo $row['id']; ?>" class="btnn">
                                        Konfirmasi
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="footer"></div>
    <script src="../script/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>
