<?php
require "koneksi.php";

// Mengecek apakah parameter ID produk telah diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data produk berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "ID produk tidak valid.";
    exit();
}

// Menangani formulir pengeditan produk yang disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $harga = floatval($_POST['harga']);
    $kategori = $_POST['kategori'];

    // Proses gambar yang diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($gambar);

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Hapus gambar lama jika berhasil diunggah yang baru
            if (file_exists($target_dir . $product['gambar'])) {
                unlink($target_dir . $product['gambar']);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // Jika tidak ada gambar yang diunggah, gunakan gambar yang lama
        $gambar = $product['gambar'];
    }

    // Update data produk
    $stmt = $conn->prepare("UPDATE produk SET nama=?, harga=?, kategori=?, gambar=? WHERE id=?");
    $stmt->bind_param("sissi", $nama, $harga, $kategori, $gambar, $id);

    if ($stmt->execute()) {
        // Tampilkan notifikasi menggunakan JavaScript dan arahkan ke liatproduk.php
        echo "<script>
                if(confirm('Product updated successfully.')){
                    window.location.href = 'liatproduk.php';
                }
            </script>";
    } else {
        echo "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
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
            background-color: #ec407a;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d81b60;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .button {
            background-color: #ec407a;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #d81b60;
        }

        .arrow-back {
            color: #ec407a;
            font-size: 24px;
            border: 2px solid #ec407a;
            border-radius: 50%;
            padding: 10px;
            transition: transform 0.3s;
        }

        .arrow-back:hover {
            transform: scale(1.2);
        }
    </style>

    <script>
        function showNotification(message, redirect) {
            alert(message);
            if (redirect) {
                window.location.href = redirect;
            }
        }
    </script>
</head>

<body>
    <h2>Edit Product</h2>

    <!-- Form untuk mengedit produk -->
    <form action="editproduk.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="nama">Product Name:</label>
        <input type="text" name="nama" value="<?php echo $product['nama']; ?>" required><br>

        <label for="harga">Price:</label>
        <input type="number" name="harga" value="<?php echo $product['harga']; ?>" required><br>

        <label for="kategori">Category:</label>
        <select name="kategori">
            <option value="Jacket" <?php echo ($product['kategori'] == 'Jacket') ? 'selected' : ''; ?>>Jacket</option>
            <option value="T-Shirt" <?php echo ($product['kategori'] == 'T-Shirt') ? 'selected' : ''; ?>>T-Shirt</option>
            <option value="Pants" <?php echo ($product['kategori'] == 'Pants') ? 'selected' : ''; ?>>Pants</option>
            <option value="Shoes" <?php echo ($product['kategori'] == 'Shoes') ? 'selected' : ''; ?>>Shoes</option>
        </select><br>

        <label for="gambar">Product Image:</label>
        <input type="file" name="gambar"><br>

        <input type="submit" value="Update Product">

    </form>
    <div style="position: fixed; top: 20px; left: 20px;">
        <a href="liatproduk.php" style="text-decoration: none; color: #333;">
            <i class="fas fa-arrow-left arrow-back"></i>
        </a>
    </div>
</body>

</html>