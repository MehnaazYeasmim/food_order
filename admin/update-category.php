<?php
include "partials/menu.php";
?>

<div class="main_content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        
        <?php

if(isset($_GET['id'])){
    
    //1. Get the id of admin to be updated 
    $id=$_GET['id'];
    
    //2. Create SQL Query to get Details
    $q="SELECT * FROM `tbl_category` WHERE id=$id";

    //Execute the query
    $res=mysqli_query($conn,$q);

    //Check whether the query is executed or not
    if($res==true){
        $count=mysqli_num_rows($res);
        if($count==1){
            
            //Get the Details
            $rows=mysqli_fetch_assoc($res);
            
            

            $title=$rows['title'];
            $current_image=$rows['image_name'];
            $featured=$rows['featured'];
            $active=$rows['active'];




        }else{
                //Create a variable to display message
                $_SESSION['no-category-found']="<div class='error'>Category not Found .</div>";

                //Redirect Page to manage catgeory
                header('location:'.SITEURL.'admin/manage-category.php');
            
        }
    }
}else{
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-category.php');
}




?>

        <form action="" method="post" enctype="multipart/form-data">
                    <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="category_title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image!=''){

                            //Display the image
                            ?>
                            <img src="<?php echo SITEURL ;?>/images/category/<?php echo $current_image ;?>" width="100px">

                            <?php

                        }else{
                            echo "<div class='error'> Image not added </div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>

                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="Featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="Featured" value="No">No

                   </td>
                </tr>
                
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="current_image" value="<?php echo $current_image ;?>">
                        <input type="hidden" name="id" value="<?php echo $id ;?>">
                        <input type="submit" value="Update Category" class="btn-secondary" name="submit">
                    </td>
                </tr>



            </table>
    </form>

</div>
</div>
<?php
include "partials/footer.php";
?>


<?php
// Process the value from form and save in database

//Check whether the button is clicked or not
    if(isset($_POST['submit'])){
        //1.get the data from form
        

            $id=$_POST['id'];
            $title=$_POST['category_title'];
            $current_image=$_POST['current_image'];
            $featured=$_POST['Featured'];
            $active=$_POST['active'];



            

            //Updating new image if selected
            //Check whether the image is selected or not
            if(isset($_FILES['image']['name'])){
                

                $image_name=$_FILES['image']['name'];

                //Check whether image is available or not.
                if($image_name!=''){
                    //Image Availbale

                    //-------------A. UPLOAD NEW IMAGE(STARTS)----------------//
                    
                    //Get the extension of our image(.jpg,.png,.gif, etc ) .eg food.jpg
                    $ext=end(explode('.', $image_name));


                    
                    //Rename the image 
                    $image_name="Food_Category_".rand(000,999).".".$ext;//e.g Food_Category_834.jpg
                    
                    
                    
                    $source_path=$_FILES['image']['tmp_name'];
                    
                    $destination_path="../images/category/".$image_name;
                    // echo $source_path. "<br>";
                    // echo $destination_path. "<br>";
                    // die();
                    
                    
                    
                    
                    //Finally upload the image
                    $upload=move_uploaded_file($source_path,$destination_path);
                    // echo $image_name. "<br>";
                    // echo $upload;
                    // die();
                    
                    
                    //Check whether the image is uploaded or not.
                    //And if it is not uploaded then we will stop the process and redirect with error message.
                    if($upload==false){
                        //Set message
                        $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                        
                        //Redirect Page to Add Category
                        header('location:'.SITEURL.'admin/manage-category.php');
                        
                        //STOP the process
                        die();
                    }
            //         //-------------A. UPLOAD NEW IMAGE(ENDS)----------------//
            //         //-------------B. REMOVE CURRENT IMAGE(STARTS)----------------//

                //remove current image if available
                    if($current_image!=''){
                        $path="../images/category/".$current_image;
                        $remove=unlink($path);


                        //Check whether the image is removed or not.
                        //If failed to remove then display the message and stop the process
                        if($remove==false){
                
                
                            //Create session  to display message
                            $_SESSION['failed-remove']="<div class='error'>Failed to remove current image.</div>";
                            
                            //Redirect to manage Category page with message
                            header('location:'.SITEURL.'admin/manage-category.php');
                            
                            //Stop the process
                            die();
                            
                        }

                    }
                    
                }
                  else{
                    $image_name=$current_image;
                }
            }else{
                //Set 
                $image_name=$current_image;
            }
        
        
            //2.SQL Query to update the data into database
            

            $sql="UPDATE `tbl_category` SET `title`='$title',`image_name`='$image_name' ,`featured`='$featured',`active`='$active' WHERE `id`=$id";
            // $sql="UPDATE `tbl_category` SET `title`='$title',`featured`='$featured',`active`='$active' WHERE `id`=$id";
            

            //3. Execute query and update data in database
            $query=mysqli_query($conn,$sql);
            
            
            //4. Check whether the(Query is Executed) data is updated.
            if($query==true){
                
                //Create a variable to display message
                $_SESSION['update']="<div class='success'>Category Updated Successfully</div>";

                //Redirect Page to manange category
                header('location:'.SITEURL.'admin/manage-category.php');

            }else{
                //Create a variable to display message
                $_SESSION['update']="<div class='error'>Failed to  Update Category</div>";

                //Redirect Page to manage category
                header('location:'.SITEURL.'admin/manage-category.php');

            }
        }


    
?>


