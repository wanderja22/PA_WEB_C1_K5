<?php
require "koneksi.php";

// Start a PHP session
session_start();

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if ($password === $confirmPassword) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username is already in use
        $result = mysqli_query($conn, "SELECT username FROM account WHERE username = '$username'");
        if ($result) {
            if (mysqli_fetch_assoc($result)) {
                echo "<script>alert('Username already in use');</script>";
            } else {
                // Insert the new user into the database
                $sql = "INSERT INTO account (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
                $insertResult = mysqli_query($conn, $sql);

                if ($insertResult) {
                    // Set session variables for the logged-in user
                    $_SESSION['username'] = $username;
                    echo "<script>alert('Registration successful');</script>";
                    // Redirect to the dashboard or another page
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script>alert('Registration failed');</script>";
                }
            }
        } else {
            echo "Error in the query: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Passwords do not match');</script>";
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

<body class="signup-body">
    <div class="wrapper">
        <h1>Sign Up</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="signup">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="E-Mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirmPassword" placeholder="Re-Enter Password" required>
            <div class="terms">
                <input type="checkbox" id="checkbox" required>
                <label for="checkbox">I agree to these <a href="#">Terms & Conditions</a></label>
            </div>
            <button type="submit" name="submit" class="btn-signup">Sign Up</button>
        </form>
        <div class="member">
            Already have an account? <a href="login.php">Login Here</a>
        </div>
    </div>
</body>

</html>