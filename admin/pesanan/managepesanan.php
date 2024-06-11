<?php
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
                <a href="managepesanan.php">
                    <p>Daftar & Status Pesanan</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="../bayar/managebayar.php">
                    <p>Status Pembayaran</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="../pengguna/managepengguna.php">
                    <p>Akun Pengguna</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="../pengembalian/managepengembalian.php" >
                    <p>Pengembalian</p>
                </a>
            </div>
        </div>

        <div class="opr">
            <div class="tabel" id="mobilTable">
                <table>
                <h3 style=" padding-block:10px;"><b>Daftar Pesanan</b></h3>

                    <thead>
                        <tr>
                            <th>Merek</th>
                            <th>Transmisi</th>
                            <th>Bahan Bakar</th>
                            <th>Nama Peminjam</th>
                            <th>Alamat</th>
                            <th>Dengan Supir/Tidak</th>
                            <th>Tanggal Pinjam</th>
                            <th>Lama Pinjam</th>
                            <th>Total Harga</th>
                            <th>Status Pesanan</th>
                            <th>Terima Pesanan</th>
                            <th>Tolak Pesanan</th>
                            <th>Hapus Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['merk']; ?></td>
                                <td><?php echo $row['transmisi']; ?></td>
                                <td><?php echo $row['bahanbakar']; ?></td>
                                <td><?php echo $row['namalengkap']; ?></td>
                                <td><?php echo $row['alamat']; ?></td>
                                <td><?php echo $row['supir']; ?></td>
                                <td><?php echo $row['tanggal']; ?></td>
                                <td><?php echo $row['lamapinjam']; ?> Hari</td>
                                <td>Rp.<?php echo $row['harga']; ?></td>
                                <td><?php echo $row['stts']; ?></td>

                                <td>
                                    <a href="terimapesanan.php?id=<?php echo $row['id']; ?>" class="btn-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                            <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="tolakpesanan.php?id=<?php echo $row['id']; ?>" class="btn-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="hapuspesanan.php?id=<?php echo $row['id']; ?>" class="btn-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg>
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