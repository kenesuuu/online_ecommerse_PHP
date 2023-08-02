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

    <section id="page-header">
        <h2>Contact us!</h2>
        <p>Lahat Masarap!</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit us now!</h2>
            <h3>Amari Location</h3>
            <div>
                <li>
                    <i class="fa fa-map"></i>
                    <p>2119 Recto Ave, Sampaloc, Manila, Philippines</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>amarisilogan@gmail.com</p>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>09662636144</p>
                </li>
                <li>
                    <i class="fa fa-clock"></i>
                    <p>Monday to Saturday: 9:00am to 8:00pm</p>
                </li>
            </div>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.9652654744855!2d120.98776095082144!3d14.601054580928976!2m3!
        1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9f84ec95555%3A0x1f2f68cb2da383ed!2sYouniversity%20Suites!5e0!3m2!1sen!2sph!4v168
        0329469710!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="map">

        </div>
    </section>

    

<?php include('../partials-front/footer.php'); ?>
</body>
</html>