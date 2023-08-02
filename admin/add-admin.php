<?php include('partial/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
    
        <?php
            if(isset($_SESSION['add'])) //Checking whether the session is set or not
            {
                echo $_SESSION['add']; //Display the session message if set
                unset($_SESSION['add']); //remove session message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text"name="email" placeholder="Your Email">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text"name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit"name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php include('partial/footer.php');?>

<?php
    //Process the Value from Form and Save it in Database
    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //Get the Data from form
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryptionwith MD5

        //SQL Query to save the data into database
        $sql="INSERT INTO tbl_admin SET
            full_name='$full_name',
            email = '$email',
            username='$username',
            password='$password'
        ";
        // Execute Query and Save Data in Database
        $conn = mysqli_connect('localhost','u680995511_Soft_desk','Ednisnava69') or die(mysqli_error()); //Database connection
        $db_select = mysqli_select_db($conn,'u680995511_amari_softdesk') or die(mysqli_error()); //Selection Database

        //Executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        
        //Check wheter the (Query is Executed) data is inserted or not and display appropriate message
        if ($res==TRUE)
        {
            //Data Inserted
            //echo"Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'><span>Admin Added Successfully.</span></div>";
            //Redirect Page Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to insert data
            //echo"failed to insert data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'><span>Failed to Delete Admin. Try Again Later.</span></div>";
            //Redirect Page Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }   

?>