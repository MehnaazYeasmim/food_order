<?php

include "../config/constants.php" ;

if(isset($_GET['id']) && isset($_GET['image_name'])){
    //Get the value and delete.
    //1. Get the id of category to be deleted 
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    // echo $image_name;
    // die();
    
    //Remove the physical image file if available
    if($image_name!=''){
        //Means image is available ,so remove it.
        $path="../images/category/".$image_name;
        
        //Remove the  image.
        $remove=unlink($path);
        
        //If failed to remove image then add an error message and stop the process.
        if($remove==false){
            
            
            //Create session  to display message
            $_SESSION['remove']="<div class='error'>Failed to delete Category</div>";
            
            //Redirect to manage Category page with message
            header('location:'.SITEURL.'admin/manage-category.php');
            
            //Stop the process
            die();
            
        }
    }
    
    //delete data from data base 
    //2. Create SQL Query to delete Category
    $q="DELETE FROM `tbl_category` WHERE id=$id";

    //Execute the query
    $res=mysqli_query($conn,$q);
    
    
    //Check whether the query is exxecuted or not
    if($res==true){
        //set session on successfull deletion of category.
        $_SESSION['delete']="<div class='success'>Category deleted Successfully</div>";
    
        //Redirect to manage Admin page with message (success/error)
        header('location:'.SITEURL.'admin/manage-category.php');
    }else{
        $_SESSION['delete']="<div class='error'>Failed to delete category</div>";
    
        //Redirect to manage category page with message.
        header('location:'.SITEURL.'admin/manage-category.php');
    
    }
    

}else{
    //Redirected to manage category page.
    header('location:'.SITEURL.'admin/manage-category.php');
    
}
?>

