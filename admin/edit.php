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

// Ambil ID mobil dari URL
$id = $_GET['id'];

// Ambil data mobil berdasarkan ID
$sql = "SELECT * FROM mobil WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Mobil tidak ditemukan";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mobil</title>
    <link rel="stylesheet" href="../css/formPesan.css">
</head>

<body>
    <div class="form-container">
    <a href="admin.php" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>
        <h2>Edit Mobil</h2>
        <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div>
                <label for="merk">Merek:</label>
                <input type="text" id="merk" name="merk" value="<?php echo $row['merk']; ?>" required>
            </div>
            <div>
                <label for="transmisi">Transmisi:</label>
                <input type="text" id="transmisi" name="transmisi" value="<?php echo $row['transmisi']; ?>" required>
            </div>
            <div>
                <label for="harga">Harga:</label>
                <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
            </div>
            <div>
                <label for="bahanbakar">Bahan Bakar:</label>
                <input type="text" id="bahanbakar" name="bahanbakar" value="<?php echo $row['bahanbakar']; ?>" required>
            </div>
            <div>
                <label for="gambar">Gambar:</label>
                <input type="file" id="gambar" name="gambar">
                <img src="<?php echo $row['gambar']; ?>" alt="Gambar Mobil" width="100">
            </div>
            <div>
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</body>

</html>
