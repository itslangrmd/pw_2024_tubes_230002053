<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($_FILES["gambar_mobil"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["gambar_mobil"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        echo "Maaf, berkas sudah ada.";
        $uploadOk = 0;
    }

    if ($_FILES["gambar_mobil"]["size"] > 500000) {
        echo "Maaf, berkas terlalu besar.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        echo "Maaf, hanya format JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, berkas Anda tidak terunggah.";
    } else {
        if (move_uploaded_file($_FILES["gambar_mobil"]["tmp_name"], $target_file)) {
            $gambar_mobil = $target_file; 
            $merek_mobil = $_POST['merek_mobil'];
            $transmisi = $_POST['transmisi'];
            $harga_mobil = $_POST['harga_mobil'];
            $jenis_bahan_bakar = $_POST['jenis_bahan_bakar'];

            $sql = "INSERT INTO mobil (gambar, merk, transmisi, harga, bahanbakar)
                    VALUES ('$gambar_mobil', '$merek_mobil', '$transmisi', '$harga_mobil', '$jenis_bahan_bakar')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Data Berhasil Ditambahkan!')</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah berkas Anda.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mobil</title>
    <link rel="stylesheet" href="../css/formPesan.css">
    <style>
    </style>
</head>
<body>
    <div class="form-container">
        <a href="admin.php" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>
        <h2>Tambah Data Mobil</h2>
        <form method="POST" action="tambah.php" enctype="multipart/form-data">
            
            <label for="merek_mobil">Merek Mobil:</label>
            <input type="text" id="merek_mobil" name="merek_mobil" required>

            <label for="transmisi">Transmisi:</label>
            <input type="text" id="transmisi" name="transmisi" required>

            <label for="harga_mobil">Harga Mobil:</label>
            <input type="text" id="harga_mobil" name="harga_mobil" required>

            <label for="jenis_bahan_bakar">Jenis Bahan Bakar:</label>
            <input type="text" id="jenis_bahan_bakar" name="jenis_bahan_bakar" required>

            <label for="gambar_mobil">Gambar Mobil:</label>
            <input type="file" id="gambar_mobil" name="gambar_mobil" required>


            <input type="submit" value="Tambah">
        </form>
    </div>
</body>
</html>
