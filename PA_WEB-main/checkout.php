<?php
require "koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Data Pembeli</title>
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-color);
            color: var(--text-color);
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: var(--second-color);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-size: 16px;
            margin: 15px 0 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #ec407a;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.35s ease;
        }

        button:hover {
            background-color: #ec407a;
            color: white;
            transform: scale(0.95);
        }
    </style>
</head>

<body>
    <h1>Formulir Data Pembeli</h1>

    <!-- Tambahkan formulir pengisian data diri pembeli di sini -->
    <form action="detailpesanan.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="alamat">Alamat Pengiriman:</label>
        <input type="text" id="alamat" name="alamat" required>

        <label for="no_hp">No Hp:</label>
        <input type="text" id="no_hp" name="no_hp" required>

        <label for="metode_pembayaran">Metode Pembayaran:</label>
        <select id="metode_pembayaran" name="metode_pembayaran" required>
            <option value="COD">COD</option>
            <option value="NGUTANG">NGUTANG</option>
            <optgroup label="Transfer Bank">
                <option value="Bank BNI">Bank BNI</option>
                <option value="Bank BCA">Bank BCA</option>
                <option value="Bank BRI">Bank BRI</option>
            </optgroup>
            <!-- Tambahkan opsi metode pembayaran lain sesuai kebutuhan -->
        </select>

        <!-- Tambahkan input tersembunyi untuk total harga -->
        <input type="hidden" name="total_harga" value="<?php echo $totalPrice; ?>">

        <button type="submit" name="submit_checkout">Submit Checkout</button>
    </form>
</body>

</html>