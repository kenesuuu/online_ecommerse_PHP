<?php include('partial/menu.php');?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1>

                <?php

                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['remove']))
                    {
                        echo$_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo$_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['no-category-found']))
                    {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }

                ?>

                <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>

               

                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                        #Query to get all categories from database
                        $sql = "SELECT * FROM tbl_category";

                        #Execute Query
                        $res = mysqli_query($conn, $sql);

                        #Count rows
                        $count = mysqli_num_rows($res);

                        #Create Serial number variable and assign value as 1
                        $sn=1;

                        #check whether we have data in data or not
                        if($count>0)
                        {
                            #We have data in database
                            #Get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['food'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 
                                            #Check whether image name is available or not
                                            if($image_name!="")
                                            {
                                                #Display the Image
                                                ?>
                                                <img src="<?php echo SITEURL;?>img/category/<?php echo $image_name; ?>" width="150px">
                                                <?php
                                            }
                                            else
                                            {
                                                #display the message
                                                echo "<div class='error'>Unavailable Image.</div>";
                                            }

                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <div class="center">
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-primary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                            }

                        }
                        else
                        {
                            #We do not have data
                            #We will display the message inside table
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No Category Added. </div></td>
                            </tr>
                            <?php
                        }

                    ?>

                    
                </table>
            </div>
        </div>

<?php include('partial/footer.php');?>