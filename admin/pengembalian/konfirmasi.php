<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalmobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $terima = "Mobil Dikembalikan";

    $sql = "UPDATE pesanan SET stts = '$terima' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: managepengembalian.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID pesanan tidak ditemukan.";
}

$conn->close();
?>
