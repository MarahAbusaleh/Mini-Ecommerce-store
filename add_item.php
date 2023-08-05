<?php
session_start();

// if (!isset($_SESSION['itemCounter'])) {
//     $_SESSION['itemCounter'] = 1;   //Counter to display the next image each time. 
// }

if(isset($_POST['addItem'])) {
    $itemName = $_POST['itemName'];     //Get Item Name Entered by user.
    $itemPrice = $_POST['itemPrice'];   //Get Item Price Entered by user.
    $itemDesc = $_POST['itemDesc'];     //Get Item Description Entered by user.
    $itemDate = $_POST['itemDate'];     //Get Item Date Entered by user.
    $itemImage = $_POST['itemImage'];     //Get Item Image Entered by user.

    if(empty($itemName) || empty($itemPrice) || empty($itemDesc) || empty($itemDate)) {     //When user click on 'Add button' without enter information about Item.
        $message = 'Please Add Item Information Before';
    } else {
        $itemCounter = $_SESSION['itemCounter'];    //Get the Counter from SESSION.
        $_SESSION['products'][] = array(    //Save the Item information as Associative Array in the SESSION.
            'itemName' => $itemName,
            'itemPrice' => $itemPrice,
            'itemDesc' => $itemDesc,
            'itemDate' => $itemDate,
            'itemImage' => $itemImage,
        );
        $message = 'Item Added Successfully';
        $_SESSION['itemCounter']++;     //Increment the Counter Each time.

        header("Location: {$_SERVER['REQUEST_URI']}?success=1");
        exit;
    }
}

if(isset($_GET['clear']) && $_GET['clear'] === 'true') {    //When user click on 'Delete button'.
    unset($_SESSION['products']);   //Delete the data in the SESSION.
    $_SESSION['itemCounter'] = 1;   //The Counter become 1 to start Add Items again. 
}

if (isset($_GET['deleteItem'])) {   //When user click on 'Delete icon' fpr each Item.
    $itemIndex = $_GET['deleteItem'];
    if (isset($_SESSION['products'][$itemIndex])) {
        unset($_SESSION['products'][$itemIndex]);
        $_SESSION['products'] = array_values($_SESSION['products']);
        $message = 'Item Deleted Successfully';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css%22/%3E">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        input[type=file]::file-selector-button {
            border: none;
            background: #f04888;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 18px;
            transition: background .2s ease-in-out;
        }
        input[type=file]::file-selector-button:hover {
            background: #f7c9e6;
            transition: .5s;
        }
        @media screen and (max-width: 480px){
            label.logo{
                padding-left: 30px;
                padding-right: 250px;
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
            <li><a class="active" href="./add_item.php">Home</a></li>
            <li><a href="./view_item.php">All Products</a></li>
        </ul>
    </nav>
    <!--//////////////////////////////////////////// END Of Nav ////////////////////////////////////////////-->

	<!----------------------------------------------- Slider ----------------------------------------------->
    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="./images/imge2.jpg">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="./images/imge3.jpg">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="./images/imgee1.jpg">
        </div>
        <div class="slider-content">
            <h2>Welcome to Our Jewellery Store</h2>
            <a href="#footer" class="btn">Contact Us</a>
        </div>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span> 
        <span class="dot" onclick="currentSlide(2)"></span> 
        <span class="dot" onclick="currentSlide(3)"></span> 
    </div>
    <!--/////////////////////////////////////////// END Of Slider ///////////////////////////////////////////-->
    
    <!----------------------------------------------- Body ----------------------------------------------->
    <div class="container">
        <div class="message-block <?php if(isset($message)) echo 'active'; ?>">     <!-- If the msg saved in SESSION -> The Item Added -> Give the msg class 'active'. -->
            <?php
                echo '<span class="message">'.$message.'</span>';   // Get the msg from SESSION and display it.
            ?>
        </div>

        <div class="itemForm">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">        <!-- The action is to stay in the same page when the user click on 'Add button'. -->
                <h3>Add New Item</h3>

                <input type="text" placeholder="Enter Item Name" name="itemName" class="box">
                <input type="number" placeholder="Enter Item Price" name="itemPrice" class="box">
                <input type="text"  placeholder="Enter Item Description"  name="itemDesc" class="box">
                <input type="date"  placeholder="Enter Item Added Date"  name="itemDate" class="box" style="color: gray"> 
                <input type="file"  placeholder="Enter Item Image"  name="itemImage" class="box" style="color: gray">
                <center><input type="submit" class="btn" name="addItem" value="Add Item"></center>

            </form>
        </div>
    </div>

    <div class="clear-session">
        <a href="?clear=true" class="btn">Delete</a>
    </div>

    <div class="itemDetails">
        <table class="itemDetails">
        <thead>
            <tr>
                <th>Item Image</th>       
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Item Description</th>
                <th>Item Date</th>
                <th>Delete Item</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($_SESSION['products'])) {
                foreach ($_SESSION['products'] as $productIndex => $product) {  //Foreach to get the Item information from the SESSION and display it in the table.
                        echo '<tr>';
                        echo '<td><img src="' ."images/" . $product['itemImage']  . '" alt="Item Image" class="itemImage"></td>';
                        echo '<td>' . $product['itemName'] . '</td>';
                        echo '<td>' . $product['itemPrice'] . '</td>';
                        echo '<td>' . $product['itemDesc'] . '</td>';
                        echo '<td>' . $product['itemDate'] . '</td>';
                        echo '<td><span class="material-symbols-outlined del" onclick="deleteItem(' . $productIndex . ')" name="Delete">delete</span></td>';
                        echo '</tr>';
                    }
            } else {
                echo '<tr><td colspan="6" class="msg">No Items Available</td></tr>';    //Display this msg when there is no Item Added yet.
            }
            ?>       
            </tbody>
        </table>
    </div>

    <div class="detail">
        <a href="./view_item.php" class="btn">All Items</a>
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
                        <a href="#"> <i class='bx bxl-instagram' ></i></a>
                        <a href="#"><i class='bx bxl-twitter'></i></a>
                        <a href="#"><i class='bx bxl-facebook'></i></i></a>
                        <a href="#"><i class='bx bxl-linkedin'></i></i></a>
                        <a href="#"><i class='bx bxl-github'></i></i></i></a>              
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--///////////////////////////////////////// END Of Footer /////////////////////////////////////////-->
    
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
        }

        function deleteItem(index) {
            if (confirm("Are you sure you want to delete this item?")) {
                window.location.href = "?deleteItem=" + index;
            }
        }
    </script>

</body>
</html>