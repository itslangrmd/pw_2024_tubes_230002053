<?php

$conn = mysqli_connect("localhost", "root", "", "rentalmobil");

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
$host = "localhost";
$username = "root";
$password = "";
$database = "rentalmobil";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["register-username"];
    $password = $_POST["register-password"];

    $sql = "INSERT INTO dataPelanggan (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Akun Berhasil Dibuat!');</script>";
    } else {
        echo "<script>alert('Akun Gagal Dibuat :(');</script>";
    }

    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="css/login.css">

</head>

<body>

    <div class="form-container">
        <form class="register-form" action="daftar.php" method="POST">
            <h2>Daftar</h2>
            <label for="register-username">Username:</label>
            <input type="username" id="register-username" name="register-username" required>
            <label for="register-password">Password:</label>
            <input type="password" id="register-password" name="register-password" required>
            <label for="register-confirm-password">Konfirmasi Password:</label>
            <input type="password" id="register-confirm-password" name="register-confirm-password" required>
            <p class="dftrr">Sudah punya akun? <a href="login.php">Login Disini</a></p>
            <button type="submit" name="register-submit">Daftar</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('.register-form');
            var passwordInput = form.querySelector('#register-password');
            var confirmPasswordInput = form.querySelector('#register-confirm-password');

            function validatePassword() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.setCustomValidity("Konfirmasi password tidak sesuai dengan password yang dimasukkan sebelumnya.");
                } else {
                    confirmPasswordInput.setCustomValidity('');
                }
            }

            passwordInput.addEventListener('change', validatePassword);
            confirmPasswordInput.addEventListener('keyup', validatePassword);
        });
    </script>
</body>

</html>