<?php include('partial/menu.php');?>
    
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <?php 

            #Check whether the id is set or not
            if(isset($_GET['id']))
            {
                #Get the Id and all other detail
                #echo "Getting the data";
                $id = $_GET['id'];
                #Create Sql Query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                #Execute the query
                $res = mysqli_query($conn, $sql);

                #Count the Rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    #Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['food'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row ['active'];
                }
                else
                {
                    #Redirect to Manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                #Redirect to nmanage Caetegory
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="food" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image !="")
                            {
                                #Display the Image
                                ?>
                                <img src="<?php echo SITEURL; ?>img/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                #display the image
                                echo"<div class='error'> Image Not Added.</div>";
                            }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                #echo "clicked";
                #Get all the valued from our form
                $id = $_POST['id'];
                $title = $_POST['food'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                #Updating New Image if selected 
                #Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    #Get the image details
                    $image_name = $_FILES['image']['name'];

                    #Check whether the image is available or not
                    if($image_name!="")
                    {
                        #Image available
                        #A. Upload the New Image
                        
                        #Auto Rename the Image
                        #Get the Extention of Image(jpg, png, gif, etc.) e.g. "specialfood1.jpg" 
                        $ext = end(explode('.', $image_name));

                        #Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; #e.g Food_Category_1.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../img/category/".$image_name;

                        #Finally Upload tAhe Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        #Check whther the image is uploaded or not
                        #If the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            #Set Message
                            $_SESSION['upload'] = "<div class='error>Failed to upload Image. </div>";
                            #redirect to add category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            #Stop the process
                            die();
                        }
                        #B. Remove the Current Image if available
                        if($current_image!=="")
                        {
                            $remove_path = "../img/category/".$current_image;
                        
                            $remove = unlink($remove_path);

                            #Check whether the image is remove or not
                            #If failed to remove then display message and stop the process
                            if($remove==$false)
                            {
                                #failed to remove the image
                                $_SESSION['failed-remove'] = "<div class='error'> Failed to Remove Current Image</div>";
                                header('location:'.SITEURL. 'admin/manage-category.php');
                                die();#Stop the Process
                            }

                        }
                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                #Update the Database
                $sql2 = "UPDATE tbl_category SET
                    food = '$title',
                    image_name='$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                #Execute the query
                $res2 = mysqli_query($conn, $sql2);

                #Redirect to Manage Category with Message
                #Check whether exceuted or not
                if($res2==true)
                {
                    #category updated
                    $_SESSION['update'] = "<div class='success'>Category Update Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    #failed to update category
                    $_SESSION['update'] = "<div class='error'> Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        
        
        ?>

    </div>
</div>

<?php include('partial/footer.php');?>