<?php include('../config/constants.php'); ?>
<?php include('../auth/login_check.php'); ?>
<?php
if(isset($_POST['add_to_cart']))
{
    $product_name = $_POST['food'];
    $product_price = $_POST['price'];
    $product_image = $_POST['image_name'];
    $quantity = $_POST['quantity'];

    $sql3 = "SELECT * FROM tbl_cart WHERE food = '$product_name'";
    $res3 = mysqli_query($conn, $sql3);
    $count3 = mysqli_num_rows($res3);

    if($count3>0)
    {
        $message1[]='Product Already Added to Cart';
    }
    else
    {
        $insert_product = mysqli_query($conn, "INSERT INTO tbl_cart (image_name, food, price, quantity)
        VALUES('$product_image','$product_name','$product_price','$quantity')");
        $message1[]='Product Added to Cart Successfully';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Amari's Fast food Restaurant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/logo.png" />
</head>
<?php 
if(isset($message1))
{
    foreach($message1 as $message1)
    {
        echo "<div><span>".$message1."</span></div>";
    }
}
?>

<body>
    <form action="" method="POST">
        <section id="header">
            <a href="index.html"><img src="../img/logo.png" style="width: 100px;" class="logo" alt=""></a>
            <div>
                <ul id="navbar">
                    <li><a href="<?php echo SITEURL; ?>auth/sign-up.php">Log in</a></li>
                    <li><a href="<?php echo SITEURL; ?>index.php">Home</a></li>
                    <li><a class="active"href="<?php echo SITEURL; ?>nav/menu.php">Menu</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/about.php">About</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/contact.php">Contact</a></li>
                    <?php 
                        $sql3 = "SELECT * FROM tbl_cart";
                        $res3 = mysqli_query($conn, $sql3) or die('query failed');
                        $count3 = mysqli_num_rows($res3);
                        ?>
                <li id="lg-bag"><a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"><span><?php echo $count3; ?></span></i></a></li>
                    <a href="#" id="close"><i class="fa fa-times"></i></a>
                </ul>
            </div>

            <div id="mobile">
                <a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"></i></a>
                <i id="bar" class="fas fa-outdent "></i>
            </div>
        </section>
        <?php 
            #Check whether food id is set or not
            if(isset($_GET['food_id']))
            {
                #Get the Food id and details of the selected food
                $food_id = $_GET['food_id'];

                #Get the details of the selected foods
                $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
                #Execute the query
                $res = mysqli_query($conn, $sql);
                #Count the rows
                $count = mysqli_num_rows($res);
                #Check whether the data is available or not
                if($count==1)
                {
                    #we have data available
                    #get the data from database
                    $row = mysqli_fetch_assoc($res);
                    
                    $food_id = $row['id'];
                    $food = $row['food'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    
                }
                else
                {
                    #Food not Available
                    #Redirect to Home Page
                    header('location:'.SITEURL);
                }
            }
            else
            {
                #Redirect to Home page
                header('location:'.SITEURL);
            }
        ?>



        <section id="prodetails" class="section-p1">
            <div class="single-pro-image">
                <?php 
                    #Check whether the image is available or not
                    if($image_name==0)
                    {
                        #Image not available
                        echo "<p>Image not Available</p>";
                    }
                    else
                    {
                        #Image is available
                        ?>
                        <img src="<?php echo SITEURL; ?>img/food/<?php echo $image_name; ?>" width="80%" id="MainImg" alt="">
                        <input type="hidden" name="image_name" value="<?php echo $image_name; ?>">
                        <?php
                    }
                ?>
                
            </div>
        
            <div class="single-pro-details">
                    <h6>Silog</h6>
                    <h4><?php echo $food; ?></h4>
                    <input type="hidden" name="food" value="<?php echo $food; ?>">

                    <h2>₱<?php echo $price; ?></h2>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <span><?php echo $description; ?></span>
                
                    <input type="hidden" name="id" value="<?php echo $food_id; ?> ">
                
                    <div class="quantity-input">
                        <button type="button" class="quantity-btn" onclick="decrementQuantity()">-</button>
                        <input type="number" value="1" min="1" name="quantity" id="quantity-input">
                        <button type="button" class="quantity-btn" onclick="incrementQuantity()">+</button>
                    </div>

                    <div class="container2">
                    <button type="submit" name="add_to_cart" class="normal">Add to Cart</button>
                    </div>
            </div>
        </section>
    </form>

    <section id="bestseller1" class="section-p1">
        <div class="seller">
            <h2>Our Best Seller</h2>
            <span>ORDER NOW!</span>
        </div>
        <?php 
            # Getting Foods from Database that are active and featured
            #SQL Query 
            $sql2 = "SELECT * FROM tbl_bestseller WHERE active='Yes' AND featured='Yes' LIMIT 9";

            #Execute The Query
            $res2 = mysqli_query($conn, $sql2);

            #Count rows
            $count2 = mysqli_num_rows($res2);

            #Check WHether food available or not
            if($count2)
            {
                #Food Available
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    #Get all the Values
                    $id = $row2['id'];
                    $food = $row2['food'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];
                    ?>

                    <div class="bs-container box-3">
                        <div class="bs-pro" onclick="window.location.href='<?php echo SITEURL; ?>menu-food/order.php?food_id=<?php echo $id; ?>'";>            
                            <?php
                                #Check whether image available or not
                                if($image_name=="")
                                {
                                    #Image not Available
                                    echo "<p>Image Not Available</p>";
                                }
                                else
                                {
                                    #Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>img/food/<?php echo $image_name; ?>" style="width: 135px;" alt="">
                                    <?php
                                }

                            ?>
                    
                            <div class ="des">
                                <span>Silog</span>
                                <h5><?php echo $food; ?></h5>
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                <h4>₱<?php echo $price; ?></h4>
                            </div>
                            <a href="<?php echo SITEURL; ?>menu-food/order.php?food_id=<?php echo $id; ?>">
                            <button>Order Now </button>
                            </a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                #Food Not Available
                echo "<p> Food not Available</p>";
            }

        ?>
    </section>

    <script>
        function incrementQuantity() {
            var quantityInput = document.getElementById('quantity-input');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decrementQuantity() {
            var quantityInput = document.getElementById('quantity-input');
            var quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
            }
        }
    </script>

    <?php include('../partials-front/footer.php'); ?>
</body>
</html>