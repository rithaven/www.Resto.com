<?php include('partials/menu.php') ?>

<div class="main-content">
           <div class="wrapper">
               <h1>Update Password</h1>
               <br><br>
           <?php
               if(isset($_GET['id']))
               {
                   $id=$_GET['id'];
               }
           ?>
               <form action="" method="POST">
                    <table action="tbl-30" method="">
                        <tr>
                            <td>Current Password:</td>
                            <td>
                                <input type="password" name="current_password" placeholder="Current Password">
                            </td>
                        </tr>
                        <tr>
                            <td>New Password:</td>
                            <td>
                                <input type="password" name="new_password" placeholder="New Password">

                            </td>
                        </tr>
                        <tr>
                            <td>Confirm Password:</td>
                            <td>
                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                            
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
               </form>
            </div>
</div>
<?php
   //Check whether the submit Button is clicked or not
   if(isset($_POST['submit']))
   {
       //echo "clicked"
       //1.Get the Data from Form
      
        $id=$_POST['id'];
        $current_password =md5($_POST['current_password']);
        $new_password =md5($_POST['new_password']);
        $confirm_password =md5($_POST['confirm_password']);

       //2.Ckeck whether the user with current ID and Current Password Exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //EXECUTE the Query
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            //Check whether data is available or not
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //user Exists and Password can be changed

                // echo "user not Found";
                // Check whether the new password and confirmation match or not
                if($new_password==$confirm_password)
                {
                    //Update the Password
                    // echo "Password Match";
                    $sql2 = "UPDATE tbl_admin SET
                         password='$new_password'
                          WHERE id=$id";

                  //Execute the Query
                  $res2 = mysqli_query($conn, $sql2);
                  //Check whether the query executed or not
                  if($res2==true)
                  {
                      //Display Success Message
                      //Redirect to Manage Admin Page with Success Message
                      $_SESSION['change-pwd']="<div class='Success'>Password changed Successfully.</div>";
                      //Redirect the user
                      header("location:".SITEURL.'admin/manage-admin.php');

                  }
                  else
                  {
                     //Redirect to Manage Admin Page with Error Message
                     $_SESSION['change-pwd']="<div class='error'>Failed to change Password.</div>";
                     //Redirect the user
                     header("location:".SITEURL.'admin/manage-admin.php');

                  }
                }

                else
                {
                    //Redirect to Manage Admin Page with Error Message
                    $_SESSION['pwd-not-match'] ="<div class='error'>Password Did not Match</div>";
                    //Redirect the User
                     header("location:".SITEURL.'admin/manage-admin.php');
  
                }
               
            }
            else
            {
             //User Exist Set Message and Redirect
             $_SESSION['user-not-found'] ="<div class='error'> user not Found </div>";
             //Redirect the User
             header("location:".SITEURL.'admin/manage-admin.php');

            }
        }  
        //3.Check whether the New Password and Confirm Password Match or not
       //4.Change Password if all above is true

   }
?>
<?php include('partials/footer.php') ?>