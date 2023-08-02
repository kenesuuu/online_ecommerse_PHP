<?php
    #Include Constant Page
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) #Either use '&&' or 'AND'
    {
        #Process to Delete
        #echo "Process to Delete";

        #Get Id and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        #Remove the Image if Available
        #Check whether the image is available or not and delete only if available
        if($image_name !=="")
        {
            #it has image and need to remove from folder
            #Get the image path
            $path ="../img/food/".$image_name;

            #Remove Image File from Folder 
            $remove = unlink($path);

            #Check whether the image is removed or not
            if($remove==false)
            {
                #Failed to Remove Image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                #Redirect to Manage food
                header('location:'.SITEURL.'admin/manage-best_seller.php');
                #Stop the process of deleting food
                die();
            }


        }


        #Delete Food from Database
        $sql = "DELETE FROM tbl_bestseller WHERE id=$id";
        #Execute the query
        $res = mysqli_query($conn, $sql);

        #check whether the query executed or not and set the session message respectively
         #Redirect to Manage Food with session message
        if($res==true)
        {
            #Food Deleted
            $_SESSION['delete'] ="<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-best_seller.php');
        }
        else
        {
            #Failed to Delete Food
            $_SESSION['delete'] ="<div class='error'>Failed to Deleted.</div>";
            header('location:'.SITEURL.'admin/manage-best_seller.php');
        }
       

    }
    else
    {
        #Redirect to manage Food Page
        #echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-best_seller.php');
    }

?>