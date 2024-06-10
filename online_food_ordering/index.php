<!DOCTYPE html>
<html lang="en">

<?php 
include ('connect.php');
// error_reporting(0);//turn of error reporting and prevent sensitive information to be displayed
// session_start()//to store and access session variable across multiple pages
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Welcome to Burricos</title>
    <!-- CSS file-->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class = "home" >
    <!-- Navigation -->
    <header class="header">
        <div class="main_page">
            <a href="index.php" class="logo">Burricos</a>
            <nav class="navigator_bar">
                <a href="view_products.php">View Food Cart</a>
                <a href="index.php">Add Item</a>
                <a href="#">Food Categories</a>
            </nav>
            <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php echo $row_count ?></sup></span></a>
        </div>
        <h1>Welcome to Burricos!</h1>
    </header>
    
    <!-- Form section -->
    <div class="container">
        <!-- Message display -->
        <?php
        if (isset($display_message)){
            echo "<div class='display_message'>
                <span>$display_message</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display = `none`';></i>
            </div>";
        }
        ?>
        <section>
            <h3 class="heading">Add Item</h3>
            <form action="" class="view_food_cart" method="post" enctype="multipart/form-data">
                <input type="number" name="product_name" placeholder="Enter Food ID:" class="input_food_id" required>
                <input type="number" name="quantity" min="0" placeholder="Enter Quantity to Order:" class="input_food_id" required>
                <input type="number" name="delivery_option" min="0" max="1" placeholder="Delivery Option (1-delivery, 0-takeaway):" class="input_food_id" required>
                <input type="file" name="food_image" class="input_food_id" required accept="image/png, image/jpg, image/jpeg">
                <input type="submit" name="add_item" class="submit_button" value="Add Item">
            </form>
        </section>
    </div>
        <!-- promotions -->
        <h2>What's new?</h2>

    <!-- JavaScript file -->
    <script src="js/script.js"></script>
</body>
</html>
