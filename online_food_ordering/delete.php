<!-- delete logic -->

<!-- php code -->
<?php 
include 'connect.php';
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    echo $delete_id;
    $delete_query = mysqli_query($conn, "DELETE FROM `order_menu` WHERE id = $delete_id")
    or die("Query failed");
    // after delete, redirect to ciew_food_cart.php
    if($delete_query){
        echo "Product removed";
        header('location:view_food_cart.php');
    }
    else{
        echo "Product not deleted";
        header('location:view_food_cart.php');
    }
}
?>