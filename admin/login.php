<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -Food order system</title>
 <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <!--Login Form Stars Here -->
        <br><br>

        <?php
             if(isset($_SESSION['login']))
             {
                 echo $_SESSION['login'];
                 unset($_SESSION['login']);

             }
             if(isset($_SESSION['no-login-message']))
             {
                 echo $_SESSION['no-login-message'];
                 unset($_SESSION['no-login-message']);

             }
        ?>
        <br><br>
        <form action="" method="POST" class="text-center">
         UserName:<br>
         <input type="text" name="username" placeholder="Enter Username"><br><br>
          Password: <br>
         <input type="password" name="password" placeholder="Enter Password"><br><br>

         <input type="submit" name="submit" value="login" class="btn-primary">
         <br><br>
        </form>
        <!--Login Form Ends Here -->
        <p class="text-center">Created By - <a href="#">Ritha</a></p>
    </div>
</body>
</html>
<?php
//check whether the submit Button is clicked or not
if(isset($_POST['submit']))
{
    //Process for login
    //1.Get the Data from login Form
   $username = $_POST['username'];
   $password = md5($_POST['password']);
  //2.SQL to check whether the user with username and password exists on not
  $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

  //3.Execute the Query
  $res = mysqli_query($conn, $sql);
 //4. count rows to check whether the user exists or not
 $count = mysqli_num_rows($res);

 if($count==1)
 {
     //user available and login success
     $_SESSION['login'] = "<div class='success' text-center> Login Successful.</div>";
     $_SESSION['user']  =$username;// To check whether the user is logged in or not and logout will unset it.

     //Redirect to Home Page/Dashboard
     header('location:'.SITEURL.'admin/');
 }
 else
 {
  //user available and login success
  $_SESSION['login'] = "<div class='error' text-center> Username or Password did not match.</div>";
  //Redirect to Home Page/Dashboard
  header('location:'.SITEURL.'admin/login.php');
 }

}
?>