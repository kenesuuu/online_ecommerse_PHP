<?php include('partial/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <?php
            // Get the ID of selected admin
            $id=$_GET['id'];

            //Create SQL query to get the details 
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                //Check wheter the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    //Get the details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc ($res);
                    
                    $email = $row['email'];
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>
        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text"name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text"name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text"name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    //CHeck whther the submit button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "button Clicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a SQL query to Update admin
        $sql = "UPDATE tbl_admin SET
        email = '$email',
        full_name = '$full_name',
        username = '$username'
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed successfully or not

        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update']="<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update']="<div class='error'>Failed to Delete Admin</div>";
            //Redirect to Manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

    }

?>

<?php include('partial/footer.php');?>