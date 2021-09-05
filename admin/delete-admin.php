<?php

include "../config/constants.php" ;

//1. Get the id of admin to be deleted 
$id=$_GET['id'];

//2. Create SQL Query to delete Admin
$q="DELETE FROM `tbl_admin` WHERE id=$id";
//Execute the query
$res=mysqli_query($conn,$q);

//Check whether the query is exxecuted or not
if($res==true){

    $_SESSION['delete']="<div class='success'>Admin deleted Successfully</div>";

    //Redirect to manage Admin page with message (success/error)
    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
    $_SESSION['delete']="<div class='error'>Failed to delete admin</div>";

    //Redirect to manage Admin page with message (success/error)
    header('location:'.SITEURL.'admin/manage-admin.php');

}




?>