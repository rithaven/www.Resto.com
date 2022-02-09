<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
     <h1>Add Category</h1>
    <br /><br />

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
    <br><br>
    <!-- Add Category Form Starts -->
    <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>
             
            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                   
                </td>
            </tr>
            
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>
              <td colspan="2">
                  <input type="submit" name="submit" value="Add Category" class="btn-secondary">
              </td>
            <tr>
</tr>



        </table>
     </form>
    <!--Add Category Form Ends---> 
    <?php
    //check whether the submit Button is clicked ot not
    if(isset($_POST['submit']))
    {
        // echo "clicked";

        //1.Get the value from CAtegory Form
        $title =$_POST['title'];

        //For Radio input, we need to check whether the button is selected or not
        if(isset($_POST['featured']))
        {
          //Get the Value from Form
          $featured = $_POST['featured'];

        }
        else
        {
           //SEt the Default Value
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
        //Check whether Image is selected or not and set the value for image name accordingly
        // print_r($_FILES['image']);

        // die();//Break the code Here
        
        if(isset($_FILES['image']['name']))
         {
            //Upload the Image
            //To upload image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];
            //Auto Rename our Image
            //Get the Extension of our image(jpg, png,gif,etc) e.g. "special.food1.jpg"
            $ext = end(explode('.', $image_name));

            //Rename the Image
            $image_name = "Food_Category_".rand(000, 999).'.'.$ext;//e.g. Food_category_834.jpg
            
            $source_path = $_FILES['image']['tmp_name'];
            
             $destination_path = "../images/category/".$image_name;

            //Finally Upload the Image
            $upload = move_uploaded_file($source_path, $destination_path);
         
            //Check whether the image is uploaded or not
            //And if the image is not uploaded then we will stop the process and redirect with error message
            if($upload==false)
            {
                //Set message
                $_SESSION['upload'] = "<div class='error'> Failed to Upload Image.</div>";
                //Redirect to Add Category Page
                header('location:'.SITEURL.'admin/add-category.php');
                //stop the Process
                die();
            }
        }
        else
        {
            //Don't Upload Image and set the image_name value as blank
            $image_name="";
        }
        //2. Create SQL QUERY TO INSERT Category into database
        $sql = "INSERT INTO tbl_category SET
              title='$title',
              image_name='$image_name',
              featured='$featured',
              active='$active'
        ";

        //3. Execute the Query and save in Database
        $res = mysqli_query($conn, $sql);

        //4. Check whether the query executed or not and data added or not
        if($res==true)
        {
         
            //Query Executed and Category Added   
            $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
            //Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else
        {
            //Failed to Add Category
            $_SESSION['add'] = "<div class='error'>Failed to Add category.</div>";
            //Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-category.php');
             
        }
        
    }
    ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
