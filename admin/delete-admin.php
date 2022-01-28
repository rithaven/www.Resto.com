<?php
    //Include constants.php file here
     include('partials/menu.php');
   // 1. get the ID of Admin to be deleted
   echo $id = $_GET['id'];
   //2. create SQL Query to delete Admin
   $sql = "DELETE FROM tbl_admin WHERE id=$id";

   //Execute the Query
   $res = mysqli_query($conn, $sql);

   // check whether the query executed successfully or not
   if($res==TRUE)
   {
        //Query Executed successfully and Admin Deleted
        //create Session Variable to display Message
        $_SESSION['delete'] = "<div id='success'>Admin deleted successfully.</div>";
        //Redirect to manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
   }
   //3.Redirect to Manage Admin page with message (success/error)
   else
   {
     //Failed to delete Admin
     $_SESSION['delete'] = "<div id='error'>Failed to Delete Admin. Try Again later .</div>";
     header('location:'.SITEURL.'admin/manage-admin.php');

   }
?>