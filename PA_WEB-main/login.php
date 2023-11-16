<?php
// Sesuaikan dengan koneksi.php Anda
require "koneksi.php";

// Start session
session_start();

// Jika pengguna sudah login, redirect ke halaman utama
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Jika formulir login dikirim
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the entered username and password match admin credentials
    if ($username === 'admin' && $password === 'admin') {
        // Set session for admin
        $_SESSION['username'] = 'admin';
        $_SESSION['is_admin'] = true;
        $welcome_message = "Welcome, Admin!";
        $_SESSION['welcome_message'] = $welcome_message;
        header("Location: liatproduk.php"); 
        exit();
    }

    // Query untuk mendapatkan data pengguna dari database
    $query = "SELECT * FROM account WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            // Set session untuk pengguna yang login
            $_SESSION['username'] = $user['username'];

            // Check if the user is an admin
            if ($user['is_admin']) {
                $_SESSION['is_admin'] = true;
                header("Location: liatproduk.php");
            } else {
                // Redirect ke halaman utama atau halaman lain yang diinginkan
                header("Location: index.php");
            }
            exit();
        } else {
            // Password tidak valid
            $error_message = "Invalid username or password.";
        }
    } else {
        // Terjadi kesalahan pada query
        $error_message = "Error in the query: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Louvy Store</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="login-body">
    <div class="wrapper">
        <h1>Login</h1>
        <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit" class="btn-login">Login</button>
        </form>
        <div class="member">
            Don't have an account? <a href="signup.php">Sign Up Here</a>
        </div>
    </div>
</body>

</html>