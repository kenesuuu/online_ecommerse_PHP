<?php include('partial/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Best seller</h1>

        <br />

                <a href="<?php echo SITEURL; ?>admin/add-best_seller.php" class="btn-primary">Add Bestseller</a>

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                ?>

                <table class="tbl-full">
                    <tr>
                        <th>ID number</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        #Create a SQL query to get all the food 
                        $sql = "SELECT * FROM tbl_bestseller";

                        #Execute the query
                        $res = mysqli_query($conn, $sql);

                        #Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        #Create serial number variable and set default value as 1
                        $id=1;
                        
                        if($count>0)
                        {
                            #We have food in database
                            #Get the food from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                #Get the values from individual columns
                                $id = $row['id'];
                                $title = $row['food'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                                <tr>
                                    <td><?php echo $id++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>₱<?php echo $price; ?></td>
                                    <td>
                                        <?php
                                        #Check whether we have image or not
                                        if($image_name=="")
                                        {
                                            #We do not have image, Display Error Message
                                            echo "<div class='error'> Image not Added</div>";
                                        }
                                        else
                                        {
                                            #We have Image, Display Image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>img/food/<?php echo $image_name; ?>" width="150px">
                                            <?php
                                        }

                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    
                                    <td>
                                        <div class="center">
                                            <a href="<?php echo SITEURL;?>admin/update-best_seller.php?id=<?php echo ($id-1);?>" class="btn-primary">Update Bestseller</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-best_seller.php?id=<?php echo ($id -1); ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Bestseller</a>
                                        </div>
                                    </td>
                                    
                                </tr>

                                <?php

                            }
                        }
                        else
                        {
                            #Food not added in Database
                            echo "<tr><td colspan='7' class='error'> Food not Added Yet </td></tr>";
                        }

                    ?>

                </table>
    </div>
</div>


<?php include('partial/footer.php');?>