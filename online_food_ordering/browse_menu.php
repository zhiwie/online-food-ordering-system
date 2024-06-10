<?php 
include 'connect.php';
if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    // Check if customer and worker are set in the form data
    if(isset($_POST['customer']) && isset($_POST['worker'])){
        $customer_id = $_POST['customer'];
        $worker_id = $_POST['worker'];

        // check if customer_id exists in the customer table
        $select_customer = mysqli_query($conn, "SELECT * FROM `customer` WHERE customer_id = '$customer_id'");
        $select_worker= mysqli_query($conn, "SELECT * FROM `worker` WHERE worker_id = '$worker_id'");
        
        if(mysqli_num_rows($select_customer)==0 && mysqli_num_rows($select_worker)==0){
            $display_message[] = "Customer ID or Worker ID does not exist";
        }else{

        // select cart data based on condition
            $select_cart = mysqli_query($conn, "SELECT * FROM `order_menu` WHERE food_name = '$product_name'");
            
            if(mysqli_num_rows($select_cart)>0){
                // if product is already appeared more than 1 time in the carts show message
                $update_quantity = mysqli_query($conn, "UPDATE `order_menu` SET quantity_ordered = quantity_ordered + $product_quantity WHERE food_name = '$product_name'");
                $display_message[] = "Product is in the cart. If you wish to change the quantity, please process to the cart";
            }

            else{
                // insert cart data in cart table
                $insert_products = mysqli_query($conn, "INSERT INTO `order_menu` (food_name, food_price, food_image, quantity_ordered, customer_id, worker_id)
                VALUES ('$product_name', '$product_price', '$product_image', '$product_quantity', '$customer_id', '$worker_id')");
                $display_message[] = "Product added to cart";
            }
        }
    }else{
        $display_message[] = "Problem in updating product, Customer ID or Worker ID is not set";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Menu</title>
    <!-- css file-->
    <link rel="stylesheet" href="css/style.css"> <!-- style.css file is present in css folder -->

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- header -->
    <?php include 'header.php'?>
    
    <div class="container">
        <?php
        if(isset($display_message)){
            foreach($display_message as $display_message){
            echo "<div class='display_message'>
            <span>$display_message</span>
            <i class = 'fas fa-times' onClick = 'this.parentElement.style.display=`none`';></i>
            </div>";
            }
        }
        ?>
        <section class="product">
            <h1 class = "heading"> Let's Eat!</h1>
            <div class="product_container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `menu_item`");
            if(mysqli_num_rows($select_products)>0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
                // echo $fetch_product['food_id'];//shows food_id if product is available
            ?>
            <form method = "post" action = "">
                <div class="edit_form">
                    <img src="images/<?php echo $fetch_product['food_image']?>" alt="">
                    
                    <h3>Burrito</h3>
                    <div class="price">Price: <?php echo $fetch_product['food_price']?></div>
                    <input type="hidden" name = "product_name" value = "<?php echo $fetch_product['food_id']?>">
                    <input type="hidden" name = "product_price" value = "<?php echo $fetch_product['food_price']?>">
                    <input type="hidden" name = "product_image"value = "<?php echo $fetch_product['food_image']?>">
                    <input type="submit" class = "submit_btn cart_btn" value = "Add to Cart" name = "add_to_cart">
                </div>
                </form>
                <?php
            }
        }
            else{
                echo "<div class='empty_text'> No Food/Drinks Available</div>";
                //by changing "echo 'no products';" to the current one it will be showned in normal row and table format instead of diamond oriented
            }
            ?>


                
            </div>
        </section>
    </div>
</body>
</html>