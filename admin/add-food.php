<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

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
                <td>Title:</td>

                <td>
                    <input type="text" name="title" placeholder=" Title of the Food">

                </td>
            </tr>
            <tr>
                   <td>Description:</td>
                   <td>
                       <textarea name="description"  cols="30" rows="5" placeholder="Description of the Food"></textarea>

                   </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">

                </td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">

                          <?php
                            //Create PHP Code to display categories from Database
                            //1. Create SQL to get active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            
                            //Execute Query
                            $res = mysqli_query($conn, $sql);

                            //Count rows to check whether we have categories or not 
                            $count = mysqli_num_rows($res);

                            //If count is greater than zero, we have categories else we do not have categories
                            if($count>0)
                            {
                                //We have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                     //get the deatails of categories
                                     $id = $row['id'];
                                     $title =$row['title'];
                                     ?>
                                         <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                     <?php

                                }
                            }
                            else
                            {
                                //We do not have category

                                ?>
                                <option value="0">No category Found</option>
                                <?php

                            }

                            //2.Display on Dropdown

                          ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured"value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active"value="No">No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">

                </td>
            </tr>


           
        </table>
        </form>
            <?php
                //check whether the button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Add the food in Database
                    // echo "clicked";

                    //1. Get the DATA from Form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";//Setting the Default value
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";//Setting Default Value
                    }


                    //2.upload the Image if selected
                    //check whether the select image is clicked or not and upload the image only if the image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        //Get the details of the selected
                        $image_name = $_FILES['image']['name'];

                        //check whether the Image is selected or not and upload image only if selected
                        if($image_name!="")
                        {
                            //Image is selected
                            //A. Rename the Image
                            //Get the extension of selected image(jpg,gif,png,etc.)
                            $ext = end(explode('.', $image_name));

                            // Create New Name for Image
                            $image_name = "Food-Name-".rand(0000,9999).".".$ext;//New Image Name may be "Food-Name-657.jpg"


                            //B.upload the Image
                            //Get the src path and description path

                            //source path is the current location of the image
                            $src = $_FILES['image']['tmp_name'];

                            //Description path for the image to be uploaded
                            $dst = "../images/food/".$image_name;

                            //Finally upload the food image
                            $upload = move_uploaded_file($src, $dst);
                            

                            //check whether image uploaded or not
                            if($upload==false)
                            {
                                 //Failed to upload the image
                                //Redirect to Add Food Page with Error Message
                                $_SESSION['upload'] ="<div class='error'>Failed to uplaod Image.</div>";
                                header('location:'.SITEURL.'admin/add-food.php');
                               //Stop the process
                                die();

                            }

                        }
                    }
                    else
                    {
                        $image_name = "";//Setting Default Value as blank

                    }

                    //3. Insert Into Database
                    //Create a SQL Query to save or Add food
                    //For Numerical we do not need to pass value inside quotes '' but for string value it is xomulsory to add quotes ''
                    $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);
                    //check whether data inserted or not
                   //4.Redirect with Message to Manage Food page

                    if($res2 == true)
                    {
                        //Data inserted successfully
                        $_SESSION['add'] ="<div class='success'>Food Added successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');

                    }
                    else
                    {

                        //FAILED TO INSERT Data
                        $_SESSION['add'] ="<div class='error'>Failed to Add Food.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');

                        
                    }
 



                }
            ?>
            </div>
</div>

<?php include('partials/footer.php'); ?>