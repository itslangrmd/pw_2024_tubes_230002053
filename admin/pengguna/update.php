<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalmobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];



$sql = "UPDATE datapelanggan SET username='$username', password='$password' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Akun berhasil diperbarui";
    header("Location: managepengguna.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
