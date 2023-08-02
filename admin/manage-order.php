<?php include('partial/menu.php');?>

<!-- Main Content Section starts-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <table class="tbl-full">
            <tr>
                <th>Id</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Payment Method</th>
                <th>Actions</th>
            </tr>

            <?php 
            $sql = "SELECT * FROM tbl_order";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                # Order Available
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $payment_method = $row['payment_method'];

                    $sql2 = "SELECT * FROM tbl_user";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);

                    if($count2 > 0)
                    {
                        while($row2 = mysqli_fetch_assoc($res2))
                        {
                            $customer_name = $row2['customer_name'];
                            $customer_contact = $row2['phone_no'];
                            $customer_email = $row2['customer_email'];
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td class="<?php echo ($status == 'Cancelled') ? 'error1' : (($status == 'Received') ? 'success1' : (($status == 'Ordered') ? 'ordered' : 'pick-up')); ?>"><?php echo $status; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $payment_method; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn-primary">Update Status</a>
                        </td>
                    </tr>
                <?php
                }
            }
            else
            {
                # Order Not Available
                echo "<tr><td colspan='12'>Order Not Available</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partial/footer.php');?>
