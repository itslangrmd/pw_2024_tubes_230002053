<?php
session_start();

if (isset($_POST['login-submit'])) {
    $inputUsername = $_POST['login-username'];
    $inputPassword = $_POST['login-password'];
    if ($inputUsername === "admin" && $inputPassword === "admin") {
        $_SESSION['login-username'] = $inputUsername;
        header("Location: admin/admin.php");
        exit();
    } else {
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $database = "rentalmobil";

        $conn = new mysqli($servername, $dbUsername, $dbPassword, $database);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM dataPelanggan WHERE username=?");
        $stmt->bind_param("s", $inputUsername);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($inputPassword === $row['password']) {
                $_SESSION['login-username'] = $inputUsername;
                echo "<script>alert('Login Berhasil!');</script>";
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Username atau Password Salah!');</script>";
            }
        } else {
            echo "<script>alert('Username atau Password Salah!');</script>";
        }
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form class="login-form" action="login.php" method="POST">
                <h2>Login</h2>
                <label for="login-username">Username:</label>
                <input type="text" id="login-username" name="login-username" required>
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="login-password" required>
                <p class="dftrr">Belum punya akun? <a href="daftar.php">Daftar Disini</a></p>
                <button type="submit" name="login-submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>