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

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $sql = "SELECT * FROM pesanan WHERE id='$orderId'";
} else {
    die("Order ID not provided");
}

$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET["id"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];
    $sttus = "Mengajukan Pengembalian";

    $sqlInsert = "INSERT INTO pengembalian (id, alamat, telepon) VALUES ('$id', '$alamat', '$telepon')";
    $sqlUpdate = "UPDATE pesanan SET stts='$sttus' WHERE id='$id'";

    if ($conn->query($sqlInsert) === TRUE && $conn->query($sqlUpdate) === TRUE) {
        header("Location: ../pesanan/daftarPesanan.php");
        exit();
    } else {
        echo "<script>alert('Pembayaran Gagal !');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="../css/bayar.css">

</head>

<body>
    <div class="container">
        <a href="../pesanan/daftarPesanan.php" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>
        <h1>Pengembalian</h1>
        <form action="#" method="post">
            <?php if ($row = $result->fetch_assoc()) { ?>
                <br>

                <div class="form-group">
                    <label for="alamat">Alamat Penjemputan:</label>
                    <input type="alamat" id="alamat" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="telepon">Nomor Telepon:</label>
                    <input type="tel" id="no_telepon" name="telepon" required>
                </div>

                <button type="submit">Ajukan Pengembalian</button>
            <?php } else { ?>
                <p>Order not found</p>
            <?php } ?>
        </form>
    </div>
</body>

</html>