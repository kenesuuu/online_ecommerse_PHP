<?php include('../config/constants.php');

require_once '../twilio-php-main/src/Twilio/autoload.php';

use Twilio\Rest\Client;

if(isset($_POST['order_now']))
{
    $quantity = 1;
    $order_date = date("Y-m-d H:i:s"); // Corrected format for order date
    $status = "Ordered"; // Ordered, Cancelled, Ready to Pick Up
    $payment_method = $_POST['payment_method'];


    $sql2 = "SELECT * FROM tbl_cart";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);
    $sub_total = 0;
    $total = 0;
    $product_name = array(); // initialize the product_name array
    if($count2 > 0)
    {
        while($row2 = mysqli_fetch_assoc($res2))
        {
            $product_name[] = $row2['food'] . '(' . $row2['quantity'] . ')';
            $sub_total = intval($row2['price']) * intval($row2['quantity']); // convert to numeric values
            $total += $sub_total;
            $product_price = intval($row2['price']);
            $quantity = $row2['quantity'];
        }
    }
    $total_product = implode(',', $product_name);

    $sql4 = "SELECT * FROM tbl_user";
    $res4 = mysqli_query($conn, $sql4);
    $count4 = mysqli_num_rows($res4);

    if($count4 > 0)
    {
        while($row4 = mysqli_fetch_assoc($res4))
        {
            $customer_name = $row4['customer_name'];
            $customer_contact = $row4['phone_no'];
            $customer_email = $row4['customer_email'];
        }
        
        
        $sql3 = "INSERT INTO tbl_order (payment_method, food, price, quantity, total, order_date, status, customer_name, phone_no, customer_email) 
        VALUES ('$payment_method','$total_product','$product_price','$quantity','$total', '$order_date','$status','".$_POST['customer_name']."','".$_POST['phone_no']."','".$_POST['customer_email']."')" or die('query failed');

        $res3 = mysqli_query($conn, $sql3);
        if ($res3) {
            echo "Order placed successfully.";

            // Send SMS notification
            #$customer_contact = $row3['phone_no'];
            $twilioAccountSid = 'AC055f384781c3e956f926e2a3e25a551c';
            $twilioAuthToken = '92f8d4d1970a672fbf9bb6a036dc0f6c';
            $twilioPhoneNumber = '+12542805111';
            $customerPhoneNumber = '+639127479921'; // Replace with the customer's phone number

            $client = new Client($twilioAccountSid, $twilioAuthToken);
            $message = $client->messages->create(
                $customerPhoneNumber,
                [
                   'from' => $twilioPhoneNumber,
                   'body' => 'Order Confirmed - Pending Payment. Thank you for your order! Payment is pending. Please complete the payment as soon as possible. For payment instructions, refer to the screen or visit our website. Once payment is made, we will process your order and send further updates via SMS. Contact our Chat Bot AI for assistance. We appreciate your orders!'
                ]
            );
            header("Location: payment.php");
            exit();
        } else {
            echo "Failed to place order.";
        }
    }
    else
    {
        echo "Customer details not found.";
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

<body>
    <form action="" method="POST">
        <section id="header">
            <a href="index.html"><img src="../img/logo.png" style="width: 100px;" class="logo" alt=""></a>
            <div>
                <ul id="navbar">
                    <li><a href="<?php echo SITEURL; ?>auth/sign-up.php">Log in</a></li>
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
                <a href="cart.html"><i class="fa fa-bag-shopping"></i></a>
                <i id="bar" class="fas fa-outdent "></i>
            </div>
        </section>
        
        <section id="page-header" class="about-header">
            <h2>Delivery Details!</h2>
            <p>Amari's serves the most delicious and affordable silogs around the University Belt!</p>
        </section>
        <h1 class="text-center">Complete your Order</h1>

        <form action="payment.php" method="POST">
            <div class="display-order">
                <?php
                    $sql = "SELECT * FROM tbl_cart";
                    $sub_total = 0;
                    $total = 0;
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $sub_total= number_format($row['price'] * $row['quantity']);
                            $total += $sub_total;
                            ?>
                                <span><?php echo $row['food'] ?>(<?php echo $row['quantity']; ?>)</span>   
                            <?php
                        }
                    }
                    else
                    {
                        echo "<div class='text-center'><span>Your Cart is Empty!</span><div>";
                    }

                    
                ?>  
                <span class="grand-total"> Total is:<?php echo $total; ?></span>
                <section class="checkout-form">
                    <?php 
                    $sql4 = "SELECT * FROM tbl_user";
                    $res4 = mysqli_query($conn, $sql4);
                    $count4 = mysqli_num_rows($res4);

                    if($count4>0)
                    {
                        while($row4=mysqli_fetch_assoc($res4))
                        {
                            $customer_name = $row4['customer_name'];
                            $customer_contact = $row4['phone_no'];
                            $customer_email = $row4['customer_email'];
                        }
                    }

                    ?>
                    <div class="flex">
                    <div class="inputbox1">
                        <span>Name: <?php echo $customer_name ?></span>
                    </div>
                    <div class="inputbox1">
                        <span>Phone Number: <?php echo $customer_contact ?></span>
                    </div>
                    <div class="inputbox1">
                        <span>Email: <?php echo $customer_email ?></span>
                    </div>
                            <span>Payment Method:</span>
                            <select name="payment_method">
                                <option value="Cash">Cash on Pick up</option>
                                <option value="Gcash">Gcash</option>
                                <option value="Paymaya">Maya</option>
                            </select>
                        </div>
                        <input type="submit" value="Order Now" name="order_now" class="normal" id="orderForm">
                    </div>
                </div>      
            </section>  
        </form>
    </form>
    
    <?php include('../partials-front/footer.php'); ?>
</body>
</html>