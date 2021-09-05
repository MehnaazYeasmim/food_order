<?php include('partials/menu.php');?>
<div class="main_content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
<?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//Displaying session message
                unset($_SESSION['upload']);//Removing Session Message
            }
?>


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
            <!----------------- Add Food Form Starts ------------>

            <form action="" method="post" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Food Title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description"  cols="20" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" placeholder="Enter Price"></td>
                </tr>

                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>

                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            // Create PHP code to display categories from database
                            // 1. Create SQL to retrive all active categories from database

                            $sql="SELECT * FROM `tbl_category` WHERE `active`='Yes'";

                            $res=mysqli_query($conn,$sql);

                            $count=mysqli_num_rows($res);//Function to get whether we have categories
                            //If count is greater then 0 ,we have categories else not.
                            if($count>0){
                                //We have data in database
                                while($rows=mysqli_fetch_assoc($res)){

                                    $id=$rows['id'];
                                    $title=$rows['title'];
                                    ?>
                                    <option value="<?php echo $id ;?>"><?php echo $title ;?></option>
                                    <?php
                                }
                            }else{
                                //We dont have category
                                ?>
                                <option value="0">No Catgeory Found</option>
                                
                                <?php


                                
                            }
                            


                            //2.Display on dropdown
                            ?>
                        </select>
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
                        <input type="submit" value="Add Food" class="btn-secondary" name="submit">
                    </td>
                </tr>



            </table>
        </form>
            <!--------------- Add Food Form Ends -------------------------->
            <?php
// Process the value from form and save in database

//Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
            //1.get the data from category form 
            
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];

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
            //     //Upload the image
            //     //To upload image we need image name,source path and destinantion path
                $image_name=$_FILES['image']['name'];


                //Upload the image only if iamge is selected
                if($image_name!=''){


                //Auto Rename the image
                //Get the extension of our image(.jpg,.png,.gif, etc ) .eg food.jpg
                $ext=end(explode('.',$image_name));

                //Rename the image 
                $image_name="Food_Name_".rand(0000,9999).".".$ext;//e.g Food_Name_834.jpg

                

                $source_path=$_FILES['image']['tmp_name'];

                $destination_path="../images/food/".$image_name;


                

            //     //Finally upload the image
                $upload=move_uploaded_file($source_path,$destination_path);
                


            //     //Check whether the image is uploaded or not.
            //     //And if it is not uploaded then we will stop the process and redirect with error message.
                if($upload==false){
                     //Set message
                    $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";

                    //Redirect Page to Add Category
                    header('location:'.SITEURL.'admin/add-food.php');

                    //STOP the process
                    die();
                }
            }
                

            }else{
                //Dont upload image and set image_name value as blank
                
                $image_name="";
            }



            //2.SQL Query to insert the category data into database

            $sql="INSERT INTO `tbl_food`( `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('$title','$description',$price,'$image_name',$category,'$featured','$active')";
            
            

            //3. Execute query and save data in database
            $query=mysqli_query($conn,$sql);
            // echo $query;
           
            
            //4. Check whether the(Query is Executed) data is inserted or not and display appripriate message 
            if($query==true){
                
                //Query executed and Category added.
                
                //Create a variable to display message
                $_SESSION['add']="<div class='success'>Food Added Successfully</div>";

                //Redirect Page to manange category page
                header('location:'.SITEURL.'admin/manage-food.php');
                

            }else{
                //Failed to add Category.
                echo "NOT Fail";
                die();
                //Create a variable to display message
                $_SESSION['add']="<div class='error'>Failed to  Add  Food</div>";

                //Redirect Page to manange category page
                header('location:'.SITEURL.'admin/manage-food.php');

            }
        }
    


    
?>


</div>
</div>
<?php
include "partials/footer.php";
?>

