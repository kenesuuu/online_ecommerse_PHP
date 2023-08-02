<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../img/logo.png" />
</head>

<body>
    <?php include('./partial/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo$_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <?php 
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
            ?>
            <div class="col-4 text-center">
                <h1><?php echo $count; ?></h1>
                <br />
                Categories: 
            </div>
            
            <div class="col-4 text-center">
                <?php 
                    $sql2 = "SELECT * FROM tbl_food";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2 ?></h1>
                <br />
                Foods: 
            </div>

            <div class="col-4 text-center">
                <?php 
                    $sql3 = "SELECT * FROM tbl_order";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3 ?></h1>
                <br />
                Total Orders: 
            </div>

            <div class="col-4 text-center">
                <?php          
                    #Aggregate Function in SQL
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Received'";
                    $res4 = mysqli_query($conn, $sql4);
                    $row4 = mysqli_fetch_assoc($res4);

                    $total_revenue = $row4['Total'];
                ?>
                <h1>₱<?php echo $total_revenue; ?></h1>
                <br />
                Revenue: 
            </div>

            <div class="clearfix"></div>
            
        </div>
    </div>

    <?php include('./partial/footer.php');?>
</body>

</html>
