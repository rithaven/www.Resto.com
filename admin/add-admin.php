<?php include('partials/menu.php') ?>
<div class="main-content">
           <div class="wrapper">
               <h1> Add Admin</h1>
              <br><br>
              <?php 
              if(isset($_SESSION['add']))//checking whether the session is set or not
              {
                echo $_SESSION['add']; // Display the Session Message if set
                unset($_SESSION['add']);//Remove Session Message 
              }
              ?>
            <form action="" method="POST">
                <table class="tbl-30">

                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter your Name">
                        </td>
                    </tr>

                    <tr>
                        <td>UserName:</td>
                        <td>
                            <input type="text" name="username" placeholder="Enter your user Name">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Enter your password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> 
                        
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
</div>
</div>
<?php include('partials/footer.php') ?>

<?php
    //Process the value from Form and save it in Database
    //check whether the button is clicked or not
    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "button clicked"

        //1.Get the Data from form
       $full_name =$_POST['full_name'];
       $username =$_POST['username'];
       $password =md5($_POST['password']);//Password encripted by md5
      
       //2.SQL Query to save the data into database
       $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        //3. Executing Query and saving Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        //4. ckeck whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            // echo "Data Inserted";
            //Cteate a session variable to display Message
            $_SESSION['add'] = "<div id='success'>Admin Added Successfully.</div>";
            //Redirect Page to Manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
              //Failed to Insert DAta
              // echo "Faile to insert Data";
              $_SESSION['add'] = "<div id='error'>Failed to Add Admin.</div>";
              //Redirect Page to Add  admin
              header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>