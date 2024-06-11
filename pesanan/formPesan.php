<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalmobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT id, merk, harga, bahanbakar, transmisi, gambar FROM mobil WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Mobil tidak ditemukan";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
    $lamapinjam = intval($_POST['lamapinjam']);
    $harga = intval($row['harga']);

    $status = "Pesanan sedang diproses";
    $hargahari = $harga * $lamapinjam;



    if (isset($_POST['supir'])) {
        $totalharga = $hargahari + 200000;
        $supir = "Dengan Supir";
    } else {
        $totalharga = $hargahari;
        $supir = "Tanpa Supir";
    }


    try {
        $sql_insert = "INSERT INTO pesanan (id, merk, harga, bahanbakar, transmisi,namalengkap, alamat, tanggal, lamapinjam, stts, supir)
                    VALUES ('{$row['id']}', '{$row['merk']}', '$totalharga', '{$row['bahanbakar']}', '{$row['transmisi']}', '$namalengkap', '$alamat', '$tanggal', '$lamapinjam', '$status','$supir')";
        $conn->query($sql_insert);
        echo "<script>alert('Pesanan Berhasil Dibuat!')</script>";
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            echo "<script>alert('Mobil ini sudah dipesan!')</script>";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan</title>
    <link rel="stylesheet" href="../css/formPesan.css">
</head>

<body>
    <div class="form-container">
        <a href="../index.php" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>
        <h2>Buat Pesanan</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $id); ?>" method="post" enctype="multipart/form-data" id="orderForm">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <img src="../admin/<?php echo $row['gambar']; ?>" alt="Gambar Mobil" width="700">

            <div class="spec">
                <h2><?php echo $row['merk']; ?></h2>
                <p>Transmisi: <?php echo $row['transmisi']; ?></p>
                <p>Harga: Rp <?php echo $row['harga']; ?></p>
                <p>Bahan Bakar: <?php echo $row['bahanbakar']; ?></p>
            </div>
            <br>
            <h4>Lengkapi Data Diri Anda</h4>
            <div>
                <label for="namalengkap">Nama Lengkap:</label>
                <input type="text" id="namalengkap" name="namalengkap" value="" required>
            </div>
            <div>
                <label for="alamat">Alamat Lengkap:</label>
                <input type="text" id="alamat" name="alamat" value="" required>
            </div>
            <div>
                <label for="tanggal">Tanggal Pinjam:</label>
                <input type="date" id="tanggal" name="tanggal" value="" required>
            </div>
            <div>
                <label for="lamapinjam">Lama Pinjam:</label>
                <input type="text" id="lamapinjam" name="lamapinjam" value="" required>
            </div>
            <div>
                <input type="checkbox" id="supir" name="supir" value="" class="checkbox">
                <span> Dengan Supir + Rp.200.000</span>
            </div>
            <br>

            <div>
                <input type="submit" value="Buat Pesanan">
            </div>
        </form>
    </div>
</body>

</html>