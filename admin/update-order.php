<?php include('partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Status</h1>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row= mysqli_fetch_assoc($res);
                $status = $row['status'];
            }
            else
            {
                echo "<div><span>Details not Available</span></div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }
        else
        {
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        ?>

        <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Add this hidden input field -->
            <table class="tbl-30">
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Pick-up"){echo "selected";} ?>value="On Pick-up">On Pick-up</option>
                            <option <?php if($status=="Received"){echo "selected";} ?>value="Received">Received</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Status" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        if(isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $status = $_POST['status'];

            $sql2 = "UPDATE tbl_order SET
            status = '$status'
            WHERE id = $id";


            $res2 = mysqli_query($conn, $sql2);

            if($res2==true)
            {
                $_SESSION['update'] = "<div class='success'><p>Status Updated</p></div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='error'><p>Failed to Update</p></div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        }
        ?>
    </div>
</div>

<?php include('partial/footer.php'); ?>