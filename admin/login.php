<?php include "../config/constants.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login Form</h1>
<?php
        if(isset($_SESSION['login'])){
                echo $_SESSION['login'];//Displaying session message
                unset($_SESSION['login']);//Removing Session Message
            }

            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];//Displaying session message
                unset($_SESSION['no-login-message']);//Removing Session Message
            }


     ?>   
     <br><br>
        <form action="" method="POST" class="text-center">

        <!-- Login Form Starts Here -->
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username">
            <br><br>

            Password:<br>
            <input type="password" name="password" placeholder="Enter password">
            <br><br>
            <input type="submit" value="Login" name="submit" class="btn-primary">
            <br ><br>
        </form>
        <!-- Login Form Ends Here -->
        <p class='text-center'>Created by- <a href="www.mehnaaz.com">Mehnaaz Yeasmim</a></p>
    </div>
</body>
</html>

<?php
//Check if Submit button is pressed or not
if(isset($_POST['submit'])){
    //Process for Login
    //1. Get the data
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    //2.SQL query to check whether the user with username and password exists or not.
    $sql="SELECT * FROM `tbl_admin` WHERE username='$username' AND password='$password'";

    //3.Execute the query
    $res=mysqli_query($conn,$sql);

    //4. Count rows to check whether user exist or not.
    $count=mysqli_num_rows($res);

    if($count==1){

        //User available and login success
        $_SESSION['login']="<div class='success'>Login Successfull</div>";
        $_SESSION['user']=$username;//To check whether the user is logged in or not and logout will unset it.

        //Redirect Page to  Home Page /dashboard
        header('location:'.SITEURL.'admin/');

    }else{

        //User not available and login fail
        $_SESSION['login']="<div class='error text-center'>Username and Password didnot matched</div>";

        //Redirect Page to  Home Page /dashboard
        header('location:'.SITEURL.'admin/login.php');

    }



}
?>