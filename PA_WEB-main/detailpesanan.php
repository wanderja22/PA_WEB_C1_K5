<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <style>
        /* Gaya CSS untuk detailpesanan.php */

        body {
            font-family: 'Poppins', sans-serif;
            background: #ffecf2;
            /* Warna latar belakang yang lembut */
            color: #333;
            /* Warna teks utama */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1,
        h2 {
            text-align: center;
            color: #ff4384;
            /* Warna judul */
        }

        p {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }

        button {
            background-color: #ff4384;
            /* Warna latar belakang tombol */
            color: #fff;
            /* Warna teks tombol */
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 20px;
            transition: all 0.35s ease;
        }

        button:hover {
            background-color: #ff1f66;
            /* Warna latar belakang tombol saat dihover */
            transform: scale(0.95);
        }

        #info-pembeli {
            border: 2px solid #ff4384;
            /* Warna border */
            border-radius: 8px;
            /* Sudut border */
            padding: 15px;
            /* Ruang dalam elemen */
            margin-top: 20px;
            /* Jarak atas dari elemen sebelumnya */
        }
    </style>
</head>

<body>
    <?php
    session_start();

    $total_harga = isset($_POST['total_harga']) ? $_POST['total_harga'] : 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_checkout'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        $metode_pembayaran = $_POST['metode_pembayaran'];
    ?>
        <div id="info-pembeli">
            <h1>Detail Pesanan</h1>
            <h2>Informasi Pembeli:</h2>
            <p><strong>Nama:</strong> <?php echo $nama; ?></p>
            <p><strong>Alamat Pengiriman:</strong> <?php echo $alamat; ?></p>
            <p><strong>No Hp:</strong> <?php echo $no_hp; ?></p>
            <p><strong>Metode Pembayaran:</strong> <?php echo $metode_pembayaran; ?></p>

            <h2>Total Harga:</h2>
            <?php
            // Ubah nilai total harga dari session menjadi float
            $total_harga = isset($_SESSION['totalPrice']) ? floatval($_SESSION['totalPrice']) : 0;
            echo "<p>Rp " . number_format($total_harga, 0, ',', '.') . "</p>";
            ?>

            <?php
            // Kosongkan keranjang setelah checkout
            require "koneksi.php"; // Pastikan file koneksi.php sudah di-require di awal
            $sqlEmptyCart = "DELETE FROM keranjang";
            if ($conn->query($sqlEmptyCart) === TRUE) {
            } else {
                echo "Error mengosongkan keranjang: " . $conn->error;
            }
            ?>

            <!-- Tombol kembali ke index.php -->
            <button onclick="window.location.href='index.php'">Kembali ke Beranda</button>
        </div>

    <?php
    } else {
        echo "<p>Data pembeli tidak ditemukan.</p>";
    }
    ?>
</body>

</html>