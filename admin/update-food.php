<?php include('partial/menu.php'); ?>

<?php 
    #Check whether id is set or not
    if(isset($_GET['id']))
    {
        #get all the details
        $id= $_GET['id'];
        
        #SQL query to get the selected food
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        #Execute the query
        $res2 = mysqli_query($conn, $sql2);

        #Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        #Get the individual values of selected food
        $title = $row2['food'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        #redirect to manage food
        #header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="food" value="<?php echo $title; ?>"></input>
                </td>
            </tr>
            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                        if($current_image=="")
                        {
                            #Image not available
                            echo "<div class='error'>Image not Available</div>";
                        }
                        else
                        {
                            #image available
                            ?>
                            <img src="<?php echo SITEURL; ?>img/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }

                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">
                        <?php 
                            #Query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            #Execute the query
                            $res = mysqli_query($conn, $sql);
                            #cOUNT Rows
                            $count = mysqli_num_rows($res);

                            #Check whether category available or not
                            if($count>0)
                            {
                                #category Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['food'];
                                    $category_id = $row['id'];
                                    
                                    #echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if ($current_category == $category_id) { echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                #Category not available
                                echo "<option value ='0'>Category not Available.</option>";
                            }

                        
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image ?>">

                    <input type="submit" name="submit" value="Update Food" class="btn-primary"></input>
                </td>
            </tr>
        </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                #echo "Button Clicked";

                #Get all the details from the form 
                $id = $_POST['id'];
                $title = $_POST['food'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                #Upload the image if selected
                #check whether upload button check or not
                if(isset($_FILES['image']['name']))
                {
                    #Upload Button Clicked
                    $image_name = $_FILES['image']['name']; #New image name

                    #Check whether the file is available or not
                    if($image_name !="")
                    {
                        #image Available
                        #A. Uploading New Image

                        #Rename the Image
                        $ext = end(explode('.',$image_name)); #Gets the extension of the image

                        $image_name = "Food-Name-".rand(0000,9999).'.'.$ext; #This will be rename image

                        #Get the Source path and destination path
                        $src_path = $_FILES['image']['tmp_name']; #Source Path
                        $dest_path = "../img/food/".$image_name; #Destination Path

                        #Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        #Check whether the image is uploaded or not
                        if($upload==false)
                        {
                            #Failed to upload
                            $_SESSION['upload'] = "<div class='error'> Failed to Upload new Image.</div>";
                            #redirect to manage food
                            header('location:'.SITEURL.'admin/manage-food.php'); 
                            #Stop the process
                            die();
                        }

                        #Remove the image if new image is uploaded and current image exists
                        #B. Remove current Image if Available
                        if($current_image !="")
                        {
                            #Current Image is Available
                            #Remove the Image
                            $remove_path = "../img/food/".$current_image;

                            $remove = unlink($remove_path);

                            #Check whether the image is remove or not
                            if($remove==false)
                            {
                                #failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove the Current Image.</div>";
                                #redirect to manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                                #stop the process
                                die();
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

                
                #Update the food in database
                $sql3 = "UPDATE tbl_food SET
                    food = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                #Execute the sql Query
                $res3 = mysqli_query($conn, $sql3);

                #Check whether the query is executed or not
                if($res==true)
                {
                    #query executed
                    $_SESSION['update'] = "<div class='success'>Code Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    #failed to update food
                    $_SESSION['update'] = "<div class='error'>Failed to update Code</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                #redirect to manage food with session message

            }

        ?>
    </div>
</div>


<?php include('partial/footer.php'); ?>