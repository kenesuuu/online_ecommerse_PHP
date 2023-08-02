<?php include('../config/constants.php'); ?>

<?php
if(isset($_GET['user_id']))
{
    $user_id = $_GET['user_id'];
    $sql5="SELECT * FROM tbl_user WHERE id=$user_id";
    $res5=mysqli_query($conn, $sql5);
    $count5 = mysqli_num_rows($res5);
    if($count5==1)
    {
        $row5=mysqli_fetch_assoc($res5);

        $user_id = $row5['id'];
        $customer_name = $row5['customer_name'];
        $username=$row5['username'];
        $phone_no = $row5['phone_no'];
        $customer_email['customer_email'];
    }
}

if(isset($_POST['add_to_cart']))
{
    $product_name = $_POST['food'];
    $product_price = $_POST['price'];
    $product_image = $_POST['image_name'];
    $product_total = 0;
    $quantity = 1;

    $sql2 = "SELECT * FROM tbl_cart WHERE id = '$user_id'";
    $res2 = mysqli_query($conn, $sql2);

    if(mysqli_num_rows($res2)>0)
    {
        $message1[]='Product Already Added to Cart';
    }
    else
    {
        $insert_product = mysqli_query($conn, "INSERT INTO tbl_cart (image_name, food, price, quantity, total)
        VALUES('$product_image','$product_name','$product_price','$quantity', '$product_total')");
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

<?php 
    $sql4 = "SELECT * FROM tbl_category";
    $res4 = mysqli_query($conn, $sql4);
    $count4 = mysqli_num_rows($res4);
    if($count4)
    {
        while($row4 = mysqli_fetch_assoc($res4))
        {
            $category_id=$row4['id'];
            #$category_name=$row4['food'];
        }
        if($category_id=1)
        {
            $category_name = "Beef";
        }
        elseif($category_id=2)
        {
            $category_name="Pork";
        }
        elseif($category_id=3)
        {
            $category_name="Chicken";
        }
        
    }
?>

<body>
    <section id="header">
    <a href="<?php echo SITEURL; ?>"><img src="../img/logo.png" style="width: 100px;" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <?php if (isset($_SESSION['e-mail'])): ?>
                    <!-- User is logged in -->
                    <li><a href="<?php echo SITEURL; ?>auth/log_out.php">Logout</a></li>
                <?php else: ?>
                    <!-- User is not logged in -->
                    <li><a href="./auth/sign-in.php">Log in</a></li>
                <?php endif; ?>
                <li><a href="<?php echo SITEURL; ?>index.php">Home</a></li>
                <li><a class="active"href="<?php echo SITEURL; ?>nav/menu.php">Menu</a></li>
                <li><a href="<?php echo SITEURL; ?>nav/about.php">About</a></li>
                <li><a href="<?php echo SITEURL; ?>nav/contact.php">Contact</a></li>
                <?php 
                $sql3 = "SELECT * FROM tbl_cart";
                $res3 = mysqli_query($conn, $sql3) or die('query failed');
                $count3 = mysqli_num_rows($res3);
                ?>
                <li id="lg-bag"><a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"><span><?php echo  $count3; ?></span></i></a></li>
                <a href="#" id="close"><i class="fa fa-times"></i></a>
            </ul>
        </div>

        <div id="mobile">
            <a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"><span><?php echo $count3; ?></span></i></a>
            <i id="bar" class="fas fa-outdent "></i>
        </div>
    </section>

    <section id="page-header">
        <h2>Order Now!</h2>
        <p>Lahat Masarap!</p>
    </section>

    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food..." required>
                <a href=""><input type="submit" name="submit" value="Search" class="btn-primary"></a>
            </form>
        </div>
    </section>

    <section id="bestseller1" class="padding-bottom">
    <div class="beef">
        <h2><?php echo $category_name; ?></h2>
    </div>
        <?php 
        # Getting Foods from Database that are active and featured
        #SQL Query 
        $sql = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes'";

        #Execute the query
        $res = mysqli_query($conn,$sql);

        #Count rows
        $count = mysqli_num_rows($res);
        
        #Check whther food available or not
        if($count)
        {
            #Food Available
            while($row = mysqli_fetch_assoc($res))
            {
                #Get all the values
                $id = $row['id'];
                $title = $row['food'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                <form action="" method="POST">
                    <div class="bs-container box-3">
                        <div class="bs-pro " onclick="window.location.href='<?php echo SITEURL; ?>menu-food/order.php?food_id=<?php echo $id; ?>';">
                            <?php
                                #Check whether image available or not
                                if($image_name=="")
                                {
                                    #Image not available
                                    echo "<p>Image not Available</p>";
                                }
                                else
                                {
                                    #Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>img/food/<?php echo $image_name; ?>" alt="">
                                    <input type="hidden" name="image_name" value="<?php echo $image_name; ?>">
                                    <?php
                                }
                            ?>
                                <div class="des">
                                    <span><?php echo "Silog" #$category_name; ?></span>
                                    <h5><?php echo $title; ?></h5>
                                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                                    <p><?php echo $description; ?></p>
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4>₱<?php echo $price; ?></h4>
                                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                                </div>
                                <?php include('../auth/login_check.php'); #The users need to log in 
                                            #first before accessing the cart
                                            ?>
                            <input type="submit" class="btn-primary" value="Add to Cart" name="add_to_cart"> 
                        </div>                
                    </div>
                </form>    
                <?php
            }
        }
        else
        {
            #Food not available
            echo "<p> Food not available</p>";
        }
        ?>        
 
    <?php  
    #</section>
    #<section id="pagination" class="section-p1 box-3">
     #   <div class="text-center">
      #      <a href="/nav/menu.html">1</a>
       #     <a href="#">2</a>
        #    <a href="#"><i class="fa fa-long-arrow-alt-right"></i></a>
        #</div>
    #</section>
    ?>
    
<?php include('../partials-front/footer.php'); ?>
</body>
</html>