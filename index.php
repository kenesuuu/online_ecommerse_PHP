<?php include('./config/constants.php'); ?>
<?php 

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
    
    <?php 
        $sql3 = "SELECT * FROM tbl_cart";
        $res3 = mysqli_query($conn, $sql3) or die('query failed');
        $count3 = mysqli_num_rows($res3);
    ?>
    <section id="header">
        <a href="<?php echo SITEURL; ?>"><img src="./img/logo.png" style="width: 100px;" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <?php if (isset($_SESSION['e-mail'])): ?>
                    <!-- User is logged in -->
                    <?php $userId = $_SESSION['e-mail']; // Store the user ID in a variable?>
                    <li><a href="<?php echo SITEURL; ?>auth/log_out.php">Logout</a></li>
                    <li><a class="active"href="index.php">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/menu.php">Menu</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/about.php">About</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/contact.php">Contact</a></li>
                    <a href="#" id="close"><i class="fa fa-times"></i></a>
                    <li id="lg-bag"><a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"><span><?php echo $count3; ?></span></i></a></li>
                <?php else: ?>
                    <!-- User is not logged in -->
                    <li><a href="./auth/sign-in.php">Log in</a></li>
                    <li><a class="active"href="index.php">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/menu.php">Menu</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/about.php">About</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/contact.php">Contact</a></li>
                    <li id="lg-bag"><a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div id="mobile">
            <a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"><span><?php echo $count3; ?></span></i></a>
            <i id="bar" class="fas fa-outdent "></i>
        </div>
    </section>

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <section id="resto">
        <h4>Amari's</h4>
        <h2>Youniversity Suites</h2>
        <h1>2119 Recto Ave, Sampaloc, Manila, Philippines</h1>
        <p>We are Amari's and we will give you the best tasting food experience there is!</p>
        <a href="<?php echo SITEURL; ?>nav/menu.php"><button>Order Now</button></a>
    </section>

    <section id="feature" class="section-p1">
        <div class="category">
            <h2>Explore Foods</h2>
        </div >
            <?php 
                #Create SQL query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'"; #LIMIT 3, we can limit the selection
                #Execute the Query
                $res = mysqli_query($conn, $sql);
                #Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    #Category Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        #Get the Values like title, image_name and id
                        $id = $row['id'];
                        $title = $row['food'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <div class="box-33 feature-flex">
                            <div class="fe-box " onclick="window.location.href='<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>'">
                                <?php 
                                    #Check whether image is available of not
                                    if($image_name=="")
                                    {
                                        #Display Message
                                        echo "<p>Image not Available</p>";
                                    }
                                    else
                                    {
                                       #Image Name is Available
                                       ?>
                                        <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" style="width: 135px;" alt="">
                                       <?php 
                                    }
                                ?>
                                 <br /><br />
                                <h6><?php echo $title; ?></h6> 
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    #Category not Available
                    echo "<div class='text-center'><p>Category not Added</p></div>";
                }
            ?>
           
    </section>

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
                $title = $row2['food'];
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
                            <h5><?php echo $title; ?></h5>
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
    <?php include('partials-front/footer.php'); ?>
</body>
</html>