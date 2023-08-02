<?php
    #Include constant file
    include('../config/constants.php');
    #Check Whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        #get the value and delete
        #echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        #remove the physical image file if available
        if($image_name !="")
        {
            #Image is Available. thus, remove it
            $path = "../img/category/".$image_name;
            #Remove the Image 
            $remove = unlink($path);

            #If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                #set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div> ";
                #redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
                #Stop the process
                die();
            }
        }
        #Delete data from database 
        #SQl query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        #Execute the query 
        $res = mysqli_query($conn, $sql);

        #Chech whether the data is delete from database or not
        if($res==true)
        {
            #Set succes message and redirect 
            $_SESSION['delete'] ="<div class='success'> Category Deleted Sucessfully.</div>";
            #Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            #set failed message and redirect
            $_SESSION['delete'] ="<div class='error'> Failed to Delete Category.</div>";
            #Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }


    } 
    else
    {
        #Redirect to Manage to category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>