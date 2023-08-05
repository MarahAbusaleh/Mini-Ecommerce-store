<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Items Page</title>
    <link rel="stylesheet" href="view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css%22/%3E">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        .social-links{
            display: grid;
            grid-template-columns: auto auto auto auto auto;
        }
        @media screen and (max-width: 480px){

            .checkbtn{
                display: block;
            }
        }
        
    </style>
</head>
<body>
    <!----------------------------------------------- NavBar ----------------------------------------------->
    <nav style="position: relative">
        <input type="checkbox" id="check">
        <div style="display: flex">
            <label class="logo">JEW</label>
            <label for="check" class="checkbtn">
                <i style="font-size:24px" class="fa fa-bars"></i>
            </label>
        </div>
        <ul style="position: absolute; right: 5px; top: 5px">
            <li><a href="./add_products.php">Home</a></li>
            <li><a class="active" href="./view_products.php">All Products</a></li>
        </ul>
    </nav>
    <!--//////////////////////////////////////////// END Of Nav ////////////////////////////////////////////-->

    <!----------------------------------------------- Body ----------------------------------------------->

    <div class="container">
        <div class="card-container">
            <?php
            if (isset($_SESSION['products'])) {
                $count = 1;
                foreach ($_SESSION['products'] as $product) {
                    echo '<div class="card">';
                    echo '<img src="' . $product['itemImage']  . '" alt="Item Image"" class="card-image">';
                    echo '<div class="card-content">';
                    echo '<h3>' . $product['itemName'] . '</h3>';
                    echo '<p>Price: ' . $product['itemPrice'] . '</p>';
                    echo '<p>' . $product['itemDesc'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    $count++;
                }
            } else {
                echo '<p>No Items Available</p>';
            }
            ?>
        </div>
    </div>

    <!--///////////////////////////////////////// END Of Body /////////////////////////////////////////-->

    <!----------------------------------------------- Footer ----------------------------------------------->
    <footer class="footer" id="footer">
        <div class="containerf">
            <div class="row">
                <div class="footer-col">
                    <h4>Our Location</h4>
                    <ul>
                        <li><a href="#">Jordan</a></li>
                        <li><a href="#">Irbid</a></li>
                        <li><a href="#">Abd-Alhamed Sharaf Street</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Order status</a></li>
                        <li><a href="#">Payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <ul>
                        <li><a href="#">marah.abusaleh12@gmail.com</a></li>
                        <li><a href="#">+962 7 9987 6142</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="https://instagram.com/marah.abusaleh.25?igshid=ZGUzMzM3NWJiOQ=="> <i class='bx bxl-instagram' ></i></a>
                        <a href="https://twitter.com/MarahAbuSaleh1?t=RbKD6ZN0qe4hlLZWP8Ed_Q&s=09"><i class='bx bxl-twitter'></i></a>
                        <a href="https://www.facebook.com/marah.a.saleh.7?mibextid=ZbWKwL"><i class='bx bxl-facebook'></i></i></a>
                        <a href="https://www.linkedin.com/in/marah-abusaleh-a4202a244"><i class='bx bxl-linkedin'></i></i></a>
                        <a href="https://github.com/MarahAbusaleh"><i class='bx bxl-github'></i></i></i></a>              
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--///////////////////////////////////////// END Of Footer /////////////////////////////////////////-->

</body>
</html>