<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalmobil";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel mobil
$sql = "SELECT * FROM mobil";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="header">
        <h1>Welcome Admin!</h1>
        <a href="../logout.php" class="logout">Log out</a>
    </div>

    <div class="content">
        <div class="nav">
            <div class="mobil">
                <a href="admin.php">
                    <p>Daftar Mobil</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="pesanan/managepesanan.php" >
                    <p>Daftar & Status Pesanan</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="bayar/managebayar.php" >
                    <p>Status Pembayaran</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="pengguna/managepengguna.php" >
                    <p>Akun Pengguna</p>
                </a>
            </div>
            <div class="pesanan">
                <a href="pengembalian/managepengembalian.php" >
                    <p>Pengembalian</p>
                </a>
            </div>
        </div>

        <div class="opr">
            <div class="tabel" id="mobilTable">
                <!-- Tabel Daftar Mobil -->
                <table>
                <h3 style=" padding-block:10px;"><b>Daftar Mobil</b></h3>

                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Merek</th>
                            <th>Transmisi</th>
                            <th>Harga</th>
                            <th>Bahan Bakar</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><img src="<?php echo $row['gambar']; ?>" alt="Gambar Mobil" width="100"></td>
                                <td><?php echo $row['merk']; ?></td>
                                <td><?php echo $row['transmisi']; ?></td>
                                <td><?php echo $row['harga']; ?></td>
                                <td><?php echo $row['bahanbakar']; ?></td>
                                <td><a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706l-1.79 1.791-2.122-2.122 1.79-1.79a.5.5 0 0 1 .706 0l1.415 1.415a.5.5 0 0 1 .001.707zM13.379 4.803l-2.122-2.122L3 10.939v2.121h2.121l8.258-8.257zm1.439-3.022-1.415-1.415a1.5 1.5 0 0 0-2.121 0l-1.79 1.79 2.122 2.122 1.79-1.79a1.5 1.5 0 0 0 0-2.121z" />
                                            <path fill-rule="evenodd" d="M1 13.5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-7a.5.5 0 0 1 1 0v7a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-10a2 2 0 0 1 2-2h7a.5.5 0 0 1 0 1H2a1 1 0 0 0-1 1v10z" />
                                        </svg>
                                    </a></td>
                                <td>

                                    <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="7"><a href="tambah.php" class="tambah-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </a></td>
                        </tr>
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