<!-- include php logic- connecting to database -->
<?php include 'connect.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Food Cart</title>

    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- header -->
    <?php include 'header.php'?>
    <!-- container -->
    <div class="container">
        <section class="display_product">
            
                    <!-- php code -->
                    <?php 
                    $display_product = mysqli_query($conn,"Select * from `order_menu`"); 
                    $num = 1;
                    // select specific table from database
                    if(mysqli_num_rows($display_product)>0){
                        // echo "yes";
                        // logic to fetch data
                        echo "<table>
                            <thead>
                                <th>No.</th>
                                <th>Item_image</th>
                                <th>Item_name</th>
                                <th>Item_price</th>
                                <th>Action</th>
                            </thead>
                            <tbody>";
                        while($row = mysqli_fetch_assoc($display_product)){//while loop to display all the items present in the database 
                        // echo $row['name']; 
                        ?>
                        <!-- display table -->
                        <tr>
                            <td><?php echo $num?></td>
                            <!-- <td><img srx = "images/<?php echo $row['image']?>" alt = <?php echo $row['name']?></td> --> //if image doesnt shows, food name will be showed instead
                            <!-- <td><?php echo $row['food_image']?></td> -->
                            
                            <td><?php echo $row['food_id']?></td>//displays food_id form database
                            <td><?php echo $row['food_price']?></td>
                            <td>
                            <a href = "delete.php?delete=<?php echo $row['food_id']?>" 
                            class = "delete_item_btn" onclick = "return confirm('Are you sure you want to remove this from your cart?');">
                            <i class = "fas fa-trash"></i></a>
                            <!-- redirect to delete.php fetch data (food_id), 
                            if click on button, confirm to delete will redirect to delete.php; else, back to view_food_cart.php -->
                            
                            <a href = "update.php?edit=<?php echo $row['food_id']?>" 
                            class = "update_cart_btn">
                            <i class = "fas fa-edit"></i></a>
                            </td>
                    </tr>
                        <?php
                        $num++;//to show the ascending number of items in food cart
                        }
                    }
                    else{
                        echo "<div class='empty_text'> No Food/Drinks Available</div>";
                    }
                    ?>
                    
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>