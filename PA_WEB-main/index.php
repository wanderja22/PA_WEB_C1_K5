<?php
require "koneksi.php";

session_start();

$countJacket = getCountJacketProducts($conn);
$countTShirt = getCountTShirtProducts($conn);
$countPants = getCountPantsProducts($conn);
$countShoes = getCountShoesProducts($conn);

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
    <script>
        var username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";
    </script>
    <script src="script.js" defer></script>
</head>

<body>
    <header>
        <a href="" class="logo">Louvy Store</a>
        <ul class="navlist">
            <li><a href="#home">Home</a></li>
            <li><a href="#catalog">Catalog</a></li>
            <li><a href="#aboutus">About Us</a></li>
            <li id="login-link"><a href="login.php">Login</a></li>
            <li id="welcome-link" style="display: none;"></li>
            <li id="logout-link" style="display: none;"><a href="logout.php">Logout</a></li>
        </ul>

        <div class="header-icon">
            <a href="keranjang.php"><i class="bx bx-shopping-bag"></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <!-- Home -->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Men's New <br /><span>Thrift Arrivals</span></h1>
            <p>New colors, now also available in men's sizing</p>
            <a href="#catalog" class="btn">View Collection</a>
        </div>
    </section>

    <!-- Catalog -->
    <section class="catalog" id="catalog">
        <div class="center-text">
            <h2>Categories</h2>
        </div>

        <div class="catalog-content">
            <div class="row">
                <div class="image-container">
                    <img src="Image/jacket.jpg" alt="Jacket">
                </div>
                <div class="cat-text">
                    <h5>Jacket</h5>
                    <p><?php echo $countJacket; ?> Items</p>
                </div>
                <div class="arrow">
                    <a href="jaket.php"><i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="image-container">
                    <img src="Image/tshirt.jpg" alt="T-shirt">
                </div>
                <div class="cat-text">
                    <h5>T-Shirt</h5>
                    <p><?php echo $countTShirt; ?> Items</p>
                </div>
                <div class="arrow">
                    <a href="tshirt.php"><i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="image-container">
                    <img src="Image/pants.jpg" alt="Pants">
                </div>
                <div class="cat-text">
                    <h5>Pants</h5>
                    <p><?php echo $countPants; ?> Items</p>
                </div>
                <div class="arrow">
                    <a href="pants.php"><i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="image-container">
                    <img src="Image/shoes.jpg" alt="Shoes">
                </div>
                <div class="cat-text">
                    <h5>Shoes</h5>
                    <p><?php echo $countShoes; ?> Items</p>
                </div>
                <div class="arrow">
                    <a href="shoes.php"><i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="aboutus" id="aboutus">
        <div class="center-text">
            <h2>About Us</h2>
        </div>

        <div class="aboutus-content">
            <div class="person">
                <div class="person-info">
                    <img src="Image/huda.jpg" alt="Person 1">
                    <h3>Miftahul Huda</h3>
                    <p>2209106098</p>
                </div>
                <div class="person-description">
                    <p>"Setiap langkah kecilmu hari ini adalah pijakan menuju impian besar. Percayalah pada dirimu sendiri dan teruslah melangkah, karena setiap usahamu memiliki makna."</p>
                </div>
            </div>
            <div class="person">
                <div class="person-info">
                    <img src="Image/arya.jpg" alt="Person 2">
                    <h3>Muhammad Arya Setyawan</h3>
                    <p>2209106101</p>
                </div>
                <div class="person-description">
                    <p>"Terkadang, langit bisa mendung, tapi jangan biarkan itu merubah semangatmu. Seperti bunga yang tetap mekar di tengah hujan, ketabahanmu akan membawa keindahan pada setiap tantangan yang datang."</p>
                </div>
            </div>
            <div class="person">
                <div class="person-info">
                    <img src="Image/tshirt.jpg" alt="Person 3">
                    <h3>Yuan Maulvi Hafiizh</h3>
                    <p>2209106107</p>
                </div>
                <div class="person-description">
                    <p>"Hidup ini seperti buku yang belum selesai. Meskipun halaman halaman sulit terkadang menantang, setiap kisah sulit pasti membawa pengajaran berharga. Tetaplah kuat dan teruslah menulis kisah hidupmu dengan keberanian."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- contact -->
    <section class="contact" id="contact">
        <div class="main-contact">
            <h3>Louvy</h3>
            <h5>Rock the World</h5>
            <div class="icons">
                <a href=""><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/hulooo._/"><i class="bx bxl-instagram"></i></a>
                <a href=""><i class="bx bxl-twitter"></i></a>
            </div>
        </div>

        <div class="main-contact">
            <h3>Explore</h3>
            <li><a href="#home">Home</a></li>
            <li><a href="#catalog">Catalog</a></li>
            <!-- <li><a href="#aboutme">About Me</a></li> -->
        </div>

        <div class="main-contact">
            <h3>Shopping</h3>
            <li><a href="">Clothing Store</a></li>
            <li><a href="">Trend</a></li>
            <li><a href="">Accessories</a></li>
        </div>
    </section>

    <footer class="last-text">
        <p>Copyright &copy; 2023 All rights reserved | Louvy Store.</p>
    </footer>
    <a href="#" class="top"><i class="bx bx-up-arrow-alt"></i></a>

    <script src="script.js"></script>
</body>

</html>