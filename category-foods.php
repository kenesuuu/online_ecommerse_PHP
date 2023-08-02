<?php include('./config/constants.php'); ?>
<?php include('./auth/login_check.php'); #The users need to log in 
#first before accessing the cart
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Amari's Fast food Restaurant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/logo.png" />
</head>

<body>
    <section id="header">
        <a href="index.html"><img src="./img/logo.png" style="width: 100px;" class="logo" alt=""></a>
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
                <li id="lg-bag"><a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"><span><?php echo $count3; ?></span></i></a></li>
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
    
    <?php 
        #Check whether id is passed or not
        if(isset($_GET['category_id']))
        {
            #Category id is set and get the id
            $category_id = $_GET['category_id'];
            #Get the category title based on category id
            $sql = "SELECT food FROM tbl_category WHERE id=$category_id";

            #Execute teh query
            $res = mysqli_query($conn, $sql);

            #Get the value from ddatabase
            $row = mysqli_fetch_assoc($res);

            #Get the title
            $category_title = $row['food'];
        }
        else
        {
            #Category not passed
            #Redirect to Home page
            header('location:'.SITEURL);
        }
    ?>

    <section id="bestseller1" class="padding-bottom">
        <div class="beef">
            <h2>Foods on <a href="#" class="text-center text-orange"><?php echo $category_title; ?></a></h2>
        </div>
        <?php 
        
            #Create SQL query to get foods based on Selected Category
            $sql2 ="SELECT * FROM tbl_food WHERE category_id=$category_id";
            #Execute the QUery
            $res2 = mysqli_query($conn, $sql2);
            #Count the rows
            $count2 = mysqli_num_rows($res2);
            #Check whether food is available or not
            if($count2>0)
            {
                #Food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['food'];
                    $price = $row2['price'];
                    $category_id = $row2 ['category_id'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                        <div class="bs-container box-3">
                            <div class="bs-pro" onclick="window.location.href='<?php echo SITEURL; ?>menu-food/order.php?food_id=<?php echo $id; ?>';">
                                <?php 
                                    #Check whether image name is available or not
                                    if($image_name=="")
                                    {
                                        #Image Not available
                                        echo "<p>Image not Available</p>";
                                    }
                                    else
                                    {
                                        #Image available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>img/food/<?php echo $image_name; ?>" alt="">
                                        <?php
                                    }
                                ?>
                                    <div class="des">
                                        <span>Silog</span>
                                        <h5><?php echo $title; ?></h5>
                                        <p><?php echo $description; ?></p>
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
                                <button>Order Now! </button>
                                </a>
                            </div>
                        </div>
                    <?php

                }
            }
            else
            {
                #Food Not available
                echo "<p>Food not Available</p>";
            }
        
        ?>
    </section>
    <?php include('./partials-front/footer.php'); ?> 
</body>
</html>