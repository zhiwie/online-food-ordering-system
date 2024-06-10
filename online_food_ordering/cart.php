<?php 
include 'connect.php';

// update query
if(isset($_POST['update_product_quantity'])){
    $update_value = $_POST['update_quantity'];
    // echo $update_value;
    $update_id = $_POST['update_quantity_id'];
    // echo $update_id;


$update_quantity_query = mysqli_query($conn, "UPDATE `order_menu` SET quantity_ordered = $update_value WHERE food_id = $update_id");//where condition is to update specific rows
if($update_quantity_query){
    header('location:cart.php');//no need to reload after update
}
}
if(isset($_GET['delete_all'])){
    //delete all related deliveries first
    mysqli_query($conn, "DELETE FROM `deliveries` WHERE `order_id` IN (SELECT `order_id` FROM `order_menu`)");
    //delete all from `order_menu`
    mysqli_query($conn, "DELETE FROM `order_menu`");
    // add onclick button
    header('location:cart.php');
}


if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `deliveries` WHERE `order_id` = $remove_id");
    //delete from `order_menu`
    mysqli_query($conn, "DELETE FROM `order_menu` WHERE id = $remove_id");
}

?>
<!-- end php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <!-- css file-->
    <link rel="stylesheet" href="css/style.css"> <!-- style.css file is present in css folder -->

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- include header -->
    <?php include 'header.php';?>
    <div class="container">
        <section class="food_cart">
            <h1 class="heading">My Cart</h1>
            <table>
                <?php
                $select_cart_products = mysqli_query($conn, "Select * from `order_menu`");
                $num = 1;
                $grand_total=0;

                if(mysqli_num_rows($select_cart_products)>0){
                    echo "
                    <thead>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>            
                    </thead>
                    <tbody>";

                    while($fetch_cart_products = mysqli_fetch_assoc($select_cart_products)){
                        
                        ?>
                        <tr>
                        <td><?php echo $num ?></td>
                        <td><?php echo $fetch_cart_products['food_name']?></td>
                        <td>
                            <img src="images/<?php echo $fetch_cart_products['food_image']?>" alt="">
                        </td>
                        <td>RM <?php echo $fetch_cart_products['food_price']?>/-</td>
                        <td>
                            <form action="" method = "post" >
                                <input type="hidden" value = "<?php echo $fetch_cart_products['food_id']?>" name = "update_quantity_id">
                                <div class="quantity_box">
                                    <input type="number" min = "1" value = <?php echo $fetch_cart_products['quantity_ordered']?> name = "update_quantity">
                                    <input type="submit" class = "update_quantity" value = "Confirm" name = "update_product_quantity">
                                </div>
                            </form>
                        </td>
                        <td>RM <?php echo $subtotal = number_format($fetch_cart_products['food_price']*$fetch_cart_products['quantity_ordered']);?>/-</td>
                        <!-- print total price accordingly -->
                        <td>
                            <a href = "cart.php?remove=<?php echo $fetch_cart_products['food_id'] ?>" onclick = "return confirm('Are you sure you want to remove this item?')">
                            <i class = "fas fa-trash"></i>Remove
                        </td>
                    </tr>
                        <?php
                        $grand_total += ($fetch_cart_products['food_price']*$fetch_cart_products['quantity_ordered']);
                        $num++;
                    } 
                }else{
                    echo "<div class = 'empty_text'> Cart is empty</div>";
                }

    ?>
                    
                </tbody>
            </table>
            <!-- php code -->
            <!-- bottom area -->
            <?php 
            if($grand_total>0){
                echo "
                    <div class='table_bottom'>
                        <a href='browse_menu.php' class = 'bottom.btn'>Continue Browsing</a>
                        <h3 class='bottom_btn'>Grand Total: RM <span>$grand_total/-</span></h3>
                        <a href='checkout.php' class = 'bottom_btn'Proceed to Checkout</a>
                    </div>";
                
            
            
            ?>
                <a href="cart.php?delete_all" class = "delete_all_btn">
                    <i class = "fas fa-trash"></i>Delete All Items</a>
                </a>
                <?php
                    }else{
                        echo "";
                    }
                ?>
        </section>
    </div>
</body>
</html>