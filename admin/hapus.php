<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM mobil WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Data mobil berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
header("Location: admin.php");
exit();
?>
