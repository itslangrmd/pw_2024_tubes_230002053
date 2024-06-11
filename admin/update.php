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
$merk = $_POST['merk'];
$transmisi = $_POST['transmisi'];
$harga = $_POST['harga'];
$bahanbakar = $_POST['bahanbakar'];
$gambar = $_FILES['gambar']['name'];
$gambar_tmp = $_FILES['gambar']['tmp_name'];

if ($gambar) {
    $gambar_folder = "uploads/" . basename($gambar);
    move_uploaded_file($gambar_tmp, $gambar_folder);
} else {
    $sql = "SELECT gambar FROM mobil WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gambar_folder = $row['gambar'];
    }
}

$sql = "UPDATE mobil SET merk='$merk', transmisi='$transmisi', harga='$harga', bahanbakar='$bahanbakar', gambar='$gambar_folder' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil diperbarui";
    header("Location: admin.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
