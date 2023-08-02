<?php include('partial/menu.php');?>

        <!-- Main Content Section starts-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin<h1>
                
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //displaying session Message
                        unset($_SESSION['add']); //Removing Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>

                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <table class="tbl-full">
                    <tr>
                        <th>ID number</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Query to get all admin 
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //check whether the query is executed or not
                        if ($res==TRUE)
                        {
                            //Count Rows to check whether we have data in database or not
                            $count = mysqli_num_rows($res); //Function to get all the rows in database

                            //Check the number of rows
                            if($count>0)
                            {
                                //We have data in database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Using while loop to get all the data from database
                                    //And while lipp will run as long as we have data in database

                                    //Get individual data
                                    $id=$rows['id'];
                                    $email=$rows['email'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display the Values in our table 
                                    ?>
                                    <tr>
                                        <td><?php echo $id;?></td>
                                        <td><?php echo $email;?></td>
                                        <td><?php echo $full_name;?></td>
                                        <td><?php echo $username;?></td>
                                        <td>
                                            <div class="center">
                                            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-blue">Change Password</a>
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-primary">Update Admin</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                            </div>
                                        </td>
                                    </tr>
                                    

                                    <?php
                                }
                            }
                            else
                            {
                                //WE do not have data in database
                            }
                        }
                    ?>
                </table>
            </div>
        </div>

<?php include('partial/footer.php');?>