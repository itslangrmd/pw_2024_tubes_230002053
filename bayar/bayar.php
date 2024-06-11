<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalmobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $sql = "SELECT * FROM pesanan WHERE id='$orderId'";
} else {
    die("Order ID not provided");
}

$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET["id"];
    $email = $_POST["email"];
    $telepon = intval($_POST["telepon"]);
    $metode = $_POST["metode"];
    $detailBayar = '';
    $sttus = "Pembayaran Menunggu Konfirmasi";

    if ($metode == 'E wallet') {
        $detailBayar = $_POST['ewallet'];
    } elseif ($metode == 'Transfer Bank') {
        $detailBayar = $_POST['bank'];
    }

    $sqlInsert = "INSERT INTO pembayaran (id, email, telepon, metode, jenis,stts) VALUES ('$id', '$email', '$telepon', '$metode', '$detailBayar', '$sttus')";
    $sqlUpdate = "UPDATE pesanan SET stts='$sttus' WHERE id='$id'";

    if ($conn->query($sqlInsert) === TRUE && $conn->query($sqlUpdate) === TRUE) {
        header("Location: berhasil.php");
        exit();
    } else {
        echo "<script>alert('Pembayaran Gagal !');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="../css/bayar.css">
    <script>
        function togglePaymentOptions() {
            const paymentMethod = document.getElementById('metode_pembayaran').value;
            const ewalletOptions = document.getElementById('ewallet-options');
            const bankOptions = document.getElementById('bank-options');
            
            if (paymentMethod === 'E wallet') {
                ewalletOptions.style.display = 'block';
                bankOptions.style.display = 'none';
            } else if (paymentMethod === 'Transfer Bank') {
                ewalletOptions.style.display = 'none';
                bankOptions.style.display = 'block';
            } else {
                ewalletOptions.style.display = 'none';
                bankOptions.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <a href="../pesanan/daftarPesanan.php" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>
        <h1>Pembayaran</h1>
        <form action="#" method="post">
        <?php if ($row = $result->fetch_assoc()) { ?>
            <br>
            <div class="form-group">
                <h3>Total Bayar Rp. <?php echo $row['harga']?></h3>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telepon">Nomor Telepon:</label>
                <input type="tel" id="no_telepon" name="telepon" required>
            </div>
            
            <div class="form-group">
                <label for="metode_pembayaran">Metode Pembayaran:</label>
                <select id="metode_pembayaran" name="metode" onchange="togglePaymentOptions()" required>
                    <option value="">Pilih Metode</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E wallet">E-Wallet</option>
                </select>
            </div>
            
            <div class="form-group" id="ewallet-options" style="display: none;">
                <label for="ewallet">E-Wallet:</label>
                <select id="ewallet" name="ewallet">
                    <option value="DANA">DANA : 086321535431</option>
                    <option value="GOPAY">GOPAY : 083452136754</option>
                </select>
            </div>

            <div class="form-group" id="bank-options" style="display: none;">
                <label for="bank">Transfer Bank:</label>
                <select id="bank" name="bank">
                    <option value="BNI">BNI : 12314124141</option>
                    <option value="Mandiri">MANDIRI : 45324141241</option>
                    <option value="BRI">BRI : 431614813741</option>
                </select>
            </div>

            <button type="submit">Konfirmasi Pembayaran</button>
        <?php } else { ?>
            <p>Order not found</p>
        <?php } ?>
        </form>
    </div>
</body>
</html>
