<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM pesanan WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Data mobil berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
header("Location: managepesanan.php");
exit();
?>
