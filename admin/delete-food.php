<?php
    // include Constants File
    include('../config/constants.php');

    //  echo "Delete Food page";
    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
      {
          //Process to Delete
          //   echo "Peocess to Delete Fodd";
         
          // 1. Get ID and image name
          $id = $_GET['id'];
          $image_name = $_GET['image_name'];

          //2. Remove the image if available
          //Check whether the image is available or not and Delete only if available
          if($image_name != "")
          {
              //IT has image and need to remove from folder
              //Get the Image Path
              $path = "../images/food/".$image_name;

              //Remove Image File from Folder
              $remove = unlink($path);

              //Check whether the image is removed or not 
              //4.Redirect to manage food with session message
              if($remove==false)
              {
                 //Failed to Remove image
                 $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                //Redirect to Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process of Deleting Food 
                die();
              }
          }

          //3.Delete food from Database
          $sql = "DELETE FROM tbl_food WHERE id=$id";
          //Execute the Query
          $res = mysqli_query($conn, $sql);

          //Check whether the query executed or not and set the session messasage
          if($res==true)
          {
              //Food deleted
              $_SESSION['delete'] = "<div class='success'>Food Deleted successfully.</div>";
              header('location:'.SITEURL.'admin/manage-food.php');


          }
          else
          {
              //Failed to Delete Food
              $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
              header('location:'.SITEURL.'admin/manage-food.php');

          }

          

      }
      else
      {
          //Redirect to manage Food  Page
        //   echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'> Unauthorized Access.<?div>";
        header('location:'.SITEURL.'admin/manage-food.php');
      }
?>