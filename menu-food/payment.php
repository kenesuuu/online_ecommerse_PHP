<?php include('../config/constants.php'); ?>

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

<body>
    <section id="header">
        <a href="<?php echo SITEURL; ?>"><img src="../img/logo.png" style="width: 100px;" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="./auth/sign-in.php">Log in</a></li>
                <li><a class="active"href="index.php">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>nav/menu.php">Menu</a></li>
                <li><a href="<?php echo SITEURL; ?>nav/about.php">About</a></li>
                <li><a href="<?php echo SITEURL; ?>nav/contact.php">Contact</a></li>
                <li><a href="<?php echo SITEURL; ?>auth/log_out.php">Logout</a></li>
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
            <a href="cart.html"><i class="fa fa-bag-shopping"></i></a>
            <i id="bar" class="fas fa-outdent "></i>
        </div>
    </section>

    <section id="page-header" class="about-header">
            <h2>Payment Now!</h2>
            <p>Amari's serves the most delicious and affordable silogs around the University Belt!</p>
    </section>

    <section>
        <div class="text-center">
            <p>Gcash:</p> <strong><span>09662636144</span></strong>
            <p>Paymaya:</p> <strong><span>09662636144</span></strong>
        </div>
        
        <div class="text-center section-m1">
            <a href="<?php echo SITEURL; ?>"><button class="normal">Back to Home Page</button></a>
        </div>
    </section>
    

    <?php include('../partials-front/footer.php'); ?>
</body>
</html>