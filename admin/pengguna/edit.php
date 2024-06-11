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

$sql = "SELECT * FROM datapelanggan WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Pengguna tidak ditemukan";
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
    <link rel="stylesheet" href="../../css/formPesan.css">
</head>

<body>
    <div class="form-container">
    <a href="managepengguna.php" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>
        <h2>Edit Data Pengguna</h2>
        <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div>
                <label for="username">Username Baru:</label>
                <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div>
                <label for="password">Password Baru:</label>
                <input type="text" id="password" name="password" value="<?php echo $row['password']; ?>" required>
            </div>
            <div>
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</body>

</html>
