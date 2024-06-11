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
$tolak = "Pesanan Ditolak";

$sql = "UPDATE pesanan SET stts = '$tolak' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: managepesanan.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
