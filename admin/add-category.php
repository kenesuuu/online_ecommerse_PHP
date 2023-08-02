<?php include('partial/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        
        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        

        <form action="" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data for inserting images-->

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="food" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>

                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>



        </form>

        <?php
            #Check whther the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                #echo "Clicked";

                #Get the value from category form
                $title = $_POST['food'];
               

                #For radio input type, we need to check whther the button is selected or not
                if(isset($_POST['featured']))
                {
                    #Get the Value from form 
                    $featured = $_POST['featured'];
                }
                else
                {
                    #Set the default Value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                #check whtther the image is selected or not and set the value for image name accordingly
                print_r($_FILES['image']);

                //die(); #Break the code here.

                if(isset($_FILES['image']['name']))
                {
                    #Upload The Image
                    #To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    #Upload the Image onlyy if image is selected
                    if($image_name !="")
                    {

                    
                        #Auto Rename the Image
                        #Get the Extention of Image(jpg, png, gif, etc.) e.g. "specialfood1.jpg" 
                        $ext = end(explode('.', $image_name));

                        #Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; #e.g Food_Category_1.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../img/category/".$image_name;

                        #Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        #Check whther the image is uploaded or not
                        #If the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            #Set Message
                            $_SESSION['upload'] = "<div class='error>Failed to upload Image. </div>";
                            #redirect to add category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            #Stop the process
                            die();
                        }

                    }
                }
                else
                {
                    #Don't upload Image and set the image_name value as blank
                    $image_name="";
                }

                # Create SQL Query to Inser Category into Database
                $sql = "INSERT INTO tbl_category SET
                    food = '$title',
                    image_name='$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                #Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                #Check whether the query is executed or not and data added or not
                if($res==true)
                {
                    #Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'><span>Category Added Successfully.</span></div>";
                    #Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    #Failed to Add Category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    #Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>