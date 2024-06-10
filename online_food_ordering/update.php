<!-- video #21,22,23,24,25 -->
<?php include 'connect.php';
//update logic
if(isset($_POST['update_product'])){
    $update_product_id = $_POST['update_product_id'];
    $update_product_name = $_POST['update_product_name'];
    $update_food_price = $_POST['update_food_price'];
    $update_product_image = $_FILES['update_product_image']['name'];
    $update_product_image_tmp_name = $_FILES['update_product_image_tmp_name']['tmp_name'];
    $update_product_image_folder = 'images/'.$update_product_image;

    // Update query with prepared statement
    $update_products = mysqli_prepare($conn, "UPDATE `food_id` SET NAME = ?, price = ?, IMAGE = ? WHERE id = ?");
    mysqli_stmt_bind_param($update_products, "sdsi", $update_product_name, $update_food_price, $update_product_image, $update_product_id);

    if (mysqli_stmt_execute($update_products)) {
        move_uploaded_file($update_product_image_tmp_name, $update_product_image_folder);
        header('location:view_food_cart.php');
        exit; // Always exit after redirection
    } else {
        $display_message = "There is some error in updating the item";
    }
}

?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cart</title>
    <!-- css file-->
    <link rel="stylesheet" href="css/style.css"> <!-- style.css file is present in css folder -->

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'header.php'?>
        <!-- message display -->
        <?php
    if (isset($display_message)){
        echo "<div class='display_message'>
        <span>.'$display_message'.</span>
        <i class = 'fas fa-times' onclick = 'this.parentElement.style.display = `none`';></i>
    </div>";
    }
    ?>
    <section class ="edit_container">
        <!-- php code -->
        <?php
        if(isset($_GET['edit'])){
            $edit_id=$_GET['edit'];
            // echo $edit_id;
            $edit_query=mysqli_query($conn, "SELECT * FROM `order_menu` WHERE id = $edit_id");
                if(mysqli_num_rows($edit_query)>0){
                    $fetch_data=mysqli_fetch_assoc($edit_query);
                    // $row = $fetch_data['price'];
                    // echo $row;
        ?>
            
            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data" class = "update_product product_container_box" >
                <img src ="images/<?php echo $fetch_data['image']?>" alt = "">
                <input type = "hidden" value="<?php echo $fetch_data['id']?>" name = "update_product_id">
                <!-- not visible while updating products -->
                <input type = "text" class = "input_fields fields" required value = "<?php echo $fetch_data['food_id']?>" name = "update_product_name">
                <input type = "number" class = "input_fields fields" required value = "<?php echo $fetch_data['food_price']?>" name = "update_food_price">
                <input type = "file" class = "input_fields fields" required accept = "image/png, image/jpg, image/jpeg" name = "update_product_image">
                <div class = "btns">
                    <input type = "submit" class= "edit_btn" value = "Update Product" name = "update_product">
                    <input type = "reset" id = "close-edit" value = "Cancel" class= "cancel_btn">
                </div> 
            </form>
                <?php
                }
        }
        ?>
        
    </section>
</body>
</html>