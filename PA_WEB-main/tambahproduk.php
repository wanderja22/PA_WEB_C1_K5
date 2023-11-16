<?php
require "koneksi.php";

$message = ""; // Variabel untuk menyimpan pesan notifikasi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $harga = floatval($_POST['harga']); // Mengubah harga menjadi tipe float
    $kategori = $_POST['kategori'];

    // Proses gambar yang diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($gambar);

        // Cek apakah gambar sudah diunggah dengan sukses
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Tidak perlu pesan output di sini
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No image uploaded or an error occurred while uploading.";
    }

    // Validasi data
    if (!empty($nama) && is_numeric($harga) && $harga > 0 && !empty($kategori) && isset($gambar)) {
        // Gunakan prepared statement untuk menghindari SQL Injection
        $stmt = $conn->prepare("INSERT INTO produk (nama, harga, kategori, gambar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $nama, $harga, $kategori, $gambar);

        if ($stmt->execute()) {
            $message = "Produk berhasil ditambahkan.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Invalid data provided.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

    <!-- Include JavaScript for displaying a notification -->
    <script>
        <?php
        // Check if there is a message to display
        if (!empty($message)) {
            // Output JavaScript to display an alert
            echo "alert('$message');";
        }
        ?>
    </script>
</head>

<body>
    <!-- Form to add a new product with an image -->
    <form action="tambahproduk.php" method="post" enctype="multipart/form-data">
        <label for="nama">Product Name:</label>
        <input type="text" name="nama" required>

        <label for="harga">Price:</label>
        <input type="number" name="harga" required>

        <label for="kategori">Category:</label>
        <select name="kategori">
            <option value="Jacket">Jacket</option>
            <option value="T-Shirt">T-Shirt</option>
            <option value="Pants">Pants</option>
            <option value="Shoes">Shoes</option>
        </select>

        <label for="gambar">Product Image:</label>
        <input type="file" name="gambar" required>

        <input type="submit" value="Add Product">
    </form>
</body>

</html>