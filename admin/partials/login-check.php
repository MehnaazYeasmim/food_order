<?php
//Authorization - Access Control
//Check whether the user is logged in or not.

if(!isset($_SESSION['user'])){ // If user session is not set

    //User is not logged in
    //Redirect to log-in page with proper message

    $_SESSION['no-login-message']="<div class='error text-center'> Please login to access admin panel</div>";

    header('location:'.SITEURL.'admin/login.php');
}
?>