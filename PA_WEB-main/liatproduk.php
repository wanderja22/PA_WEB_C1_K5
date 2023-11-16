<?php
session_start();

// Check if the user is logged in as admin
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    $welcome_message = isset($_SESSION['welcome_message']) ? $_SESSION['welcome_message'] : '';
    unset($_SESSION['welcome_message']); // Clear the welcome message once displayed

    require "koneksi.php";

    // Query to retrieve products and order them by category
    $sql = "SELECT * FROM produk ORDER BY kategori";
    $result = $conn->query($sql);
} else {
    // Redirect users who are not admins
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            position: relative;
            /* Tambahkan properti ini */
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        /* Tambahkan gaya untuk logo "back" */
        .back-logo {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 99;
            cursor: pointer;
            color: #ec407a;
            font-size: 24px;
            border: 2px solid #ec407a;
            border-radius: 50%;
            padding: 10px;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        .back-logo:hover {
            background-color: #f3e5f5;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #ec407a;
            color: white;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f3e5f5;
        }

        img {
            max-width: 180px;
            height: auto;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .button {
            background-color: #ec407a;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            border-radius: 5px;
            transition: transform 0.3s ease;
            /* Tambahkan efek transform untuk zoom */
        }

        .button:hover {
            transform: scale(1.1);
            /* Zoom in saat dihover */
        }

        .logout-button {
            position: absolute;
            top: -5px;
            right: 20px;
            z-index: 99;
        }

        .logout-button-style {
            position: absolute;
            top: -5px;
            right: 20px;
            z-index: 99;
            cursor: pointer;
            color: #ec407a;
            font-size: 24px;
            border: 2px solid #ec407a;
            border-radius: 50%;
            padding: 10px;
            background-color: #fff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .logout-button-style:hover {
            background-color: #f3e5f5;
            border-color: #ec407a;
        }

        /* Tambahkan gaya untuk ikon Font Awesome */
        .fa-icon {
            font-size: 22px;
            margin-right: 25px;
        }

        .edit-icon {
            color: #2196F3;
        }

        .delete-icon {
            color: #F44336;
        }
    </style>
</head>

<body>
    <!-- Tambahkan logo "back" -->
    <div class="back-logo" onclick="window.location.href='index.php';">
        <i class="fas fa-arrow-left"></i>
    </div>

    <!-- Add a Logout button -->
    <div class="logout-button">
        <button class="logout-button-style" onclick="logout()"><i class="fas fa-sign-out-alt"></i></button>
    </div>

    <h2>Product List</h2>

    <!-- Display products in a table -->
    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        <?php
        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['harga']}</td>";
            echo "<td>{$row['kategori']}</td>";
            echo "<td><img src='upload/{$row['gambar']}' alt='{$row['nama']}'></td>";
            echo "<td>
                    <a href='editproduk.php?id={$row['id']}' title='Edit'><i class='fas fa-edit fa-icon edit-icon'></i></a>
                    <a href='hapusproduk.php?id={$row['id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")' title='Delete'><i class='fas fa-trash-alt fa-icon delete-icon'></i></a>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Tombol "Create Product" dalam sel tabel -->
    <div class="button-container">
        <a class="button" href="tambahproduk.php">Create Product</a>
    </div>

    <script>
        // Display welcome alert
        window.onload = function() {
            var welcomeMessage = "<?php echo $welcome_message; ?>";
            if (welcomeMessage !== '') {
                alert(welcomeMessage);
            }
        };

        function logout() {
            if (confirm("Apakah Anda yakin ingin logout?")) {
                window.location.href = 'logout.php';
            }
        }
    </script>

</body>

</html>