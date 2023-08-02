<?php include('partial/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Best Seller</h1>

            <?php 
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="food" placeholder="Name of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                #Display Categories from Database
                                #Create a SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='YES'";

                                #Executing Query
                                $res = mysqli_query($conn, $sql);

                                #count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                #If count is greater then 0, we have categories else we don't have categories
                                if($count>0)
                                {
                                    #We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        #Get the detailes of category
                                        $id = $row['id'];
                                        $title = $row['food'];
                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option> 

                                        <?php 
                                        
                                    }
                                }
                                else
                                {
                                    #We do not have categories
                                    ?>
                                    <option value="0">No Categories Found</option>
                                    <?php
                                }

                                #Display on Dropdown
                            ?>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Feature: </td>
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
                    <input type="submit" name="submit" value="Add Best Seller" class="btn-primary">
                    </td>
                </tr>

            </table>

            </form>

            <?php 
            
                #check whether the button is clicked or not
                if(isset($_POST['submit']))
                {
                    #Add the Food in Data
                    
                    #Get the data from Form
                    $title = $_POST['food'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    #Check whether radio button for featured and active are checked or not
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No"; #Setting Default Value
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";
                    }


                    #Upload the Image if Selected
                    #Check whether the select image is clicked or nor and upload the image only if the image is selected 
                    if(isset($_FILES['image']['name']))
                    {
                        #Get the details of the selected image
                        $image_name = $_FILES['image']['name'];

                        #Check whether the image is selected or not and upload image only if selected
                        if($image_name!="")
                        {
                            #Image is selected
                            #Rename the Image
                            #Get the extension of selected Image(jpg. png. gif. etc.) "sleep.jpg" sleep jpg
                            $ext = end(explode('.', $image_name));

                            #Create New Name for image
                            $image_name = "Food-Name-".rand(0000,9999).".".$ext; #New Image name maybe like "Food-Name-657.jpg"

                            #Upload the Image
                            #get the source path and destination path

                            #Source Path is the current  location of the image
                            $src=$_FILES['image']['tmp_name'];

                            #Destination Path for the image to be uploaded
                            $dst = "../img/food/".$image_name;

                            #Finally, upload the food image 
                            $upload = move_uploaded_file($src, $dst);

                            #Check whether image uploaded or no
                            if($upload==false)
                            {
                                #Failed to upload the image
                                #Redirect to Add Food Page with error message
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                                header('location:'.SITEURL.'admin/add-best_seller.php');
                                #Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = ""; #Setting to default value as blank
                    }

                    #Insert into Database
                    #Create a sql query to save or add food
                    #For numerical value we do not ned to pass value inside quotes '' But for string value it is necessary to add quoted ""
                    $sql2 ="INSERT INTO tbl_bestseller SET
                        food = '$title',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    #Execute the Query
                    $res2 = mysqli_query($conn, $sql2);
                    #Check whether data inserted or not

                    if($res2 ==true)
                    {
                        #Data inserted sucessfully
                        #Data inserted successfully
                        $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-best_seller.php');

                    }
                    else
                    {
                        #Failed to insert data
                        #Failed to insert data
                        $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                        header('location:'.SITEURL.'admin/manage-best_seller.php');

                    }
                    #Redirect with Message to Manage Foof Page
                }
            
            ?>

        </div>
    </div>


<?php include('partial/footer.php');?>