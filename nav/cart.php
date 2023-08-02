<?php include('../config/constants.php'); ?>
<?php include('../auth/login_check.php'); #The users need to log in 
#first before accessing the cart
?>

<?php
$sql = "SELECT * FROM tbl_cart";

if(isset($_POST['update-cart']))
{  
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE tbl_cart SET quantity = '$update_value' 
    WHERE id = '$update_id'");
    if($update_quantity_query)
    {
        header('location:'.SITEURL.'nav/cart.php');
    }
}

if (isset($_GET['remove']))
{
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM tbl_cart WHERE id = '$remove_id'");
    header('location:'.SITEURL.'nav/cart.php');
}


?>


 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Online Ordering Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="../img/logo.png" />
</head>

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
                <li><a href="<?php echo SITEURL; ?>nav/menu.php">Menu</a></li>
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
        <h2>Order na!</h2>
        <p>Lahat Masarap!</p>
    </section>
    
    <section id="cart" class="section-p1 quantity">
        <table width="100%">
            <thead>
                <tr> 
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                </tr>
            </thead>
            <tbody>

                <?php  
                 
                $sql = "SELECT * FROM tbl_cart ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res); 
                $total = 0;
                $sub_total =0;
                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        
                        $id = $row ['id'];
                        $product_name = $row['food'];
                        $product_price = $row['price'];
                        $product_image = $row['image_name'];
                        $quantity = $row['quantity'];   
                        ?>
                            <tr>
                             <td><img src="<?php echo SITEURL; ?>img/food/<?php echo $product_image; ?>"></td>
                                <td><a href="<?php echo SITEURL; ?>menu-food/order.php?food_id=<?php echo $id; ?>"><?php echo $product_name; ?></a></td>
                                <td>₱<?php echo $row['price'] ?></td>
                                <td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="update_quantity_id" value="<?php echo $id; ?>">
                                        <input type="number" min="1" name="update_quantity" value="<?php echo $quantity; ?>">
                                        <button type="submit" name="update-cart" class="btn-primary"><i class="fa fa-pen-to-square"></i></button>
                                    </form>
                                </td>
                                </td>
                                <td>₱<?php echo $sub_total = intval($row['price']) * intval($row['quantity']); ?></td>
                                
                                <td><a href="cart.php?remove=<?php echo $id; ?>" onclick="return confirm('Remove item from cart?')"><i class="far fa-times-circle"></i></a></td>
                                
                            </tr>
                        <?php
                            $total += $sub_total;
                    }
                }
                else
                {
                    echo "<div class='text-center section-p1'>Your Cart is Empty!</div>";
                }
                ?>
            </tbody>
        </table>      
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>
        <div id="subtotal">
            
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>₱<?php echo $sub_total; ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>₱<?php echo $total; ?></strong></td>
                </tr>
            </table>
            <a href="../menu-food/checkout.php"><button class="normal">Proceed to checkout</button></a>
        </div>
    </section>
<?php include('../partials-front/footer.php'); ?>
</body>
</html>