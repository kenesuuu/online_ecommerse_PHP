<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Online Ordering Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/logo.png" />
</head>

<body>
    <?php 
        $sql3 = "SELECT * FROM tbl_cart";
        $res3 = mysqli_query($conn, $sql3) or die('query failed');
        $count3 = mysqli_num_rows($res3);
    ?>
    <section id="header">
    <a href="<?php echo SITEURL; ?>"><img src="../img/logo.png" style="width: 100px;" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <?php if (isset($_SESSION['e-mail'])): ?>
                    <!-- User is logged in -->
                    <li><a href="<?php echo SITEURL; ?>auth/log_out.php">Logout</a></li>
                    <li><a href="<?php echo SITEURL; ?>index.php">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/menu.php">Menu</a></li>
                    <li><a class="active" href="<?php echo SITEURL; ?>nav/about.php">About</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/contact.php">Contact</a></li>
                    <li id="lg-bag"><a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"><span><?php echo $count3; ?></span></i></a></li>
                    <a href="#" id="close"><i class="fa fa-times"></i></a>
                <?php else: ?>
                    <!-- User is not logged in -->
                    <li><a href="./auth/sign-in.php">Log in</a></li>
                    <li><a href="<?php echo SITEURL; ?>index.php">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/menu.php">Menu</a></li>
                    <li><a class="active" href="<?php echo SITEURL; ?>nav/about.php">About</a></li>
                    <li><a href="<?php echo SITEURL; ?>nav/contact.php">Contact</a></li>
                    <li id="lg-bag"><a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"></span></i></a></li>
                    <a href="#" id="close"><i class="fa fa-times"></i></a>
                <?php endif; ?>   
            </ul>
        </div>

        <div id="mobile">
            <a href="<?php echo SITEURL; ?>nav/cart.php"><i class="fa fa-bag-shopping"><span><?php echo $count3; ?></span></i></a>
            <i id="bar" class="fas fa-outdent "></i>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>#KnowUs!</h2>
        <p>Amari's serves the most delicious and affordable silogs around the University Belt!</p>
    </section>

    <section id="about-header" class="section-p1">
        <img src="/img/about us.jpg" alt="">
        <div>
            <h2>Who We Are?</h2>
            <abbr title="Amari's serves the most delicious and affordable silogs around the University Belt!"></abbr>

            <br><br>

            <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">Amari's serves the most delicious and affordable 
                silogs around the University Belt!
            </marquee>
        </div>
    </section>

    <?php include('../partials-front/footer.php'); ?>
</body>
</html>