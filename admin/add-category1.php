<?php include('partials/menu.php');?>
<div class="main_content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php 
            //
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//Displaying session message
                unset($_SESSION['add']);//Removing Session Message
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//Displaying session message
                unset($_SESSION['upload']);//Removing Session Message
            }
            ?>
            <br><br>
            <!-- Add Category Form Starts -->

            <form action="" method='post' enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="category_title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>

                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="Featured" value="Yes">Yes
                        <input type="radio" name="Featured" value="No">No
                </td>
                </tr>
                
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <input type="submit" value="Add Category" class="btn-secondary" name="submit">
                    </td>
                </tr>



            </table>
        </form>
            <!-- Add Category Form Ends -->
            <?php
// Process the value from form and save in database

//Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
            //1.get the data from category form 

            
            $title=$_POST['category_title'];

            //For radio input type we need to check whether the button is selected or not.
            if(isset($_POST['Featured'])){

                //Get the value from form
                $featured=$_POST['Featured'];

            }else{

                //Set the default value.
                $featured="No";
            }

            if(isset($_POST['active'])){

                $active=$_POST['active'];
            }else{
                 $active="No";
            }

            // Check whether the image is selected or not and set the image name accordingly.
            // print_r($_FILES['image']);
            // exit();

            if(isset($_FILES['image']['name'])){
                //Upload the image
                //To upload image we need image name,source path and destinantion path
                $image_name=$_FILES['image']['name'];

                $source_path=$_FILES['image']['tmp_name'];

                $destination_path="../images/category/".$image_name;

                

                //Finally upload the image
                $upload=move_uploaded_file($source_path,$destination_path);


                //Check whether the image is uploaded or not.
                //And if it is not uploaded then we will stop the process and redirect with error message.
                if($upload==false){
                    //Set message
                    $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";

                    //Redirect Page to Add Category
                    header('location:'.SITEURL.'admin/add-category.php');

                    //STOP the process
                    die();
                }
                

            }else{
                //Dont upload image and set image_name value as blank
                $image_name="";
            }


            //2.SQL Query to insert the category data into database

            $sql="INSERT INTO `tbl_category`( `title`,`image_name`,`featured`,`active`) VALUES ('$title','$image_name',$featured','$active')";
            // $sql="INSERT INTO `tbl_category`( `title`,`featured`,`active`) VALUES ('$title','$featured','$active')";
            // $sql="INSERT INTO tbl_category SET
            // title=$title,
            // image_name=$image_name,
            // featured=$featured,
            // active=$active";

            //3. Execute query and save data in database
            $query=mysqli_query($conn,$sql);

            
            //4. Check whether the(Query is Executed) data is inserted or not and display appripriate message 
            if($query==true){
                //Query executed and Category added.
                
                //Create a variable to display message
                $_SESSION['add']="<div class='success'>Category Added Successfully</div>";

                //Redirect Page to manange category page
                header('location:'.SITEURL.'admin/manage-category.php');
                

            }else{

                //Failed to add Category.

                //Create a variable to display message
                $_SESSION['add']="<div class='error'>Failed to  Add  Category</div>";

                //Redirect Page to manange category page
                header('location:'.SITEURL.'admin/add-category.php');

            }
        }


    
?>


</div>
</div>
<?php
include "partials/footer.php";
?>

