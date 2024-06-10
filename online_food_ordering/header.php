<!--header-->
<!-- <header class = "header"> -->
<header id = "header" class = "header-scroll top-header headrom">

<div class= "main_page">
    <a href = "index.php" class="logo">Burricos</a>
    <nav class= "navigator_bar">
        <a href = "view_products.php">View Food Cart</a>
        <a href = "index.php">Add Item</a>
        <a href = "">Food Categories</a>
    </nav>

    <!--'view food cart' icon-->
    <!-- select query -->
    <?php
    $select_product = mysqli_query ($conn, "Select * from `order_menu`") or die("Query failed");
    $row_count = mysqli_num_rows($select_product);
    echo $row_count;
    ?>
    <!-- shopping cart icon -->
    <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php 
    echo $row_count ?></sup></span></a> <!--show  icon together with # of items within the cart -->
    <!-- <div id="menu-bar" class = "fas fa-bars"></div>  -->
</div>
    <h1>Welcome to Burricos!</h1>
 </header>