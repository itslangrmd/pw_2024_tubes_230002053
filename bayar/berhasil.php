<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <style>
        body {
            background-color: #ffffff;
            color: #000000;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            border: 2px solid #000;
            padding: 50px;
            border-radius: 10px;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1em;
            margin-bottom: 40px;
        }
        .button {
            text-decoration: none;
            color: #fff;
            background-color: #000;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pembayaran Sedang Diproses</h1>
        <p>Terima kasih atas pembayaran Anda. Transaksi Anda Sedang Diproses</p>
        <a href="../pesanan/daftarPesanan.php" class="button">Kembali ke Beranda</a>
    </div>
</body>
</html>
