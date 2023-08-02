<?php

    //Include constants.php file here
    include('../config/constants.php');

    //get the ID of admin to be deleted
    $id = $_GET['id'];
    //Create SQL query to delete admin
    $sql = " DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check twheteher the query executed sucessfulyy or not
    if($res==true)
    {
        //Query Exceuted Successfully ands Admin Deleted
        //echo"Admin Delete";
        //Create Session Variable to display message
        $_SESSION['delete'] = "<div class='success'><span>Admin Deleted Successfully.<span></div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to delete admin
        //echo"Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'><span>Failed to Delete Admin. Try Again Later.<span></div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //Redirect to Manage admin page with message(success or error)




?>