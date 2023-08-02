<?php include('partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Old Password: </td>
                    <td>
                        <input type="password" name="old_password" placeholder="Old Password"> 
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password"name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        //echo "Clicked";

        // Get the Data from Form
        $id=$_POST['id'];
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // Check whether the user with current ID and old passowrd Exists or not
        $sql ="SELECT * FROM tbl_admin WHERE id=$id AND PASSWORD= '$old_password'";

        #Execute the Query
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $count=mysqli_num_rows($res);

            if ($count==1)
            {
                #User Exists and Password can be changed
                //echo "User Found";
                #check whether the new password and confirm match or not
                if($new_password==$confirm_password)
                {
                    #Update the password
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id=$id  
                    ";
                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    #Check whther the query is executed or not
                    if($res2==true)
                    {
                        #Display Success message
                        $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully. </div>";
                        #Redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        #Display Error Message
                        $_SESSION['change-pwd'] = "<div class='error'> Failed to Change Password. </div>";
                        #Redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    #Redirect to Manage admin page with error message
                    $_SESSION['pwd-not-match'] = "<div class='error'> Password Did Not Match. </div>";
                    #Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                #User does not exists set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'> User Not Found. </div>";
                #Redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        //Check Whether the New Passowrd and Confirm password match or not

        // Change password of all above is true
    }

?>

<?php include('partial/footer.php'); ?>