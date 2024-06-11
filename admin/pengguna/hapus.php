<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM datapelanggan WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
header("Location: managepengguna.php");
exit();
?>
