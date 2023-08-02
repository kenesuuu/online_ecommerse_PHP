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

    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food..." required>
                <i><input type="submit" name="submit" value=search" class="btn-primary"></i>
            </form>
        </div>
    </section>

    <section id="bestseller1" class="padding-bottom">
        <div class="beef">
        <?php
        #Get the search keyword
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        ?> 
            <h2>You search for <a href="#" class="text-center"><?php echo $search; ?></a></h2>
        </div>

        <?php  
            
            #SQL query to get foods based on search
            $sql = "SELECT * FROM tbl_food WHERE food LIKE '%$search%' OR description LIKE '%$search%'";

            #Execute the query
            $res = mysqli_query($conn, $sql);

            #Count rows
            $count = mysqli_num_rows($res);

            #Check whether food available or not
            if($count>0)
            {
                #Food Available
                while($row=mysqli_fetch_assoc($res))
                {
                    #Get the details
                    $id = $row['id'];
                    $title = $row['food'];
                    $price = $row ['price'];
                    $description = $row ['description'];
                    $image_name = $row ['image_name'];
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
                #Food not available
                echo "<p>Food not Found</p>";
            }
        ?>

        <?php include('./partials-front/footer.php'); ?>
</body>
</html>