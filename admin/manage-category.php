<?php
include "partials/menu.php";
?>

<div class="main_content">
    <div class="wrapper">

        <h1>Manage Category </h1>
        <br><br><br>


<?php 
            
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//Displaying session message
                unset($_SESSION['add']);//Removing Session Message
            }
            //
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];//Displaying session message
                unset($_SESSION['remove']);//Removing Session Message
            }      

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//Displaying session message
                unset($_SESSION['delete']);//Removing Session Message
            }

            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];//Displaying session message
                unset($_SESSION['no-category-found']);//Removing Session Message
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//Displaying session message
                unset($_SESSION['update']);//Removing Session Message
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//Displaying session message
                unset($_SESSION['upload']);//Removing Session Message
            }

            
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];//Displaying session message
                unset($_SESSION['failed-remove']);//Removing Session Message
            }



            ?>
        <br><br>
            <!-- Button to add Admin -->
            <!-- <button class='btn-primary'><a href="#">Add Admin</a></button> -->
            <a href="<?php echo SITEURL ; ?>admin/add-category.php" class='btn-primary'>Add Category</a>
            
            <br><br><br>

            <table class='tbl-full'>
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>


                </tr>
                
                <?php
                    //Query to get all category
                    $sql="SELECT * FROM `tbl_category`";
                    //Execute the query
                    $res=mysqli_query($conn,$sql);
                    
                    //Check whether the query is executed or not
                    
                    if($res==TRUE){
                        //Count rows to check whether we have data in database or not
                        $count=mysqli_num_rows($res);//Function to get all the rows in database
                        $sn=1;//Create a serial number  variable and assign a value
                        if($count>0){
                            //We have data in database
                            while($rows=mysqli_fetch_assoc($res)){
                                //Using while loop to fetch all data from the database
                                //And while loop will run as long as we will have data in the database
                                
                                //Get indivudial data
                                $id=$rows['id'];
                                $title=$rows['title'];
                                $image_name=$rows['image_name'];
                                $featured=$rows['featured'];
                                $active=$rows['active'];

                                
                                //Display values in our table
                                ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>

                            <td>
                                <?php 
                                    //Check whether image name is available or not 
                                    if($image_name!=""){
                                        //Display the image
                                        ?>
                                            <img src="<?php echo SITEURL ;?>/images/category/<?php echo $image_name ;?>" width="100px" >

                                        <?php
                                    }else{
                                        //Display the message
                                        echo " <div class='error'>Image not added</div>";
                                    }
                                ?>
                            </td>

                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>

                            <td>
                                <a href="<?php echo SITEURL ;?>admin/update-category.php?id=<?php echo $id ;?>" class='btn-secondary'> Update Category</a>
                                <a href="<?php echo SITEURL ;?>admin/delete-category.php?id=<?php echo $id ;?>&image_name=<?php echo $image_name ;?>" class='btn-danger'> Delete Category</a>
                            </td>
                        </tr>
                        
                        <?php
                            }
                        }
                    }else{
                        //we dont have data in database
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added</div></td>
                        </tr>
                        <?php
                    }
                    
                    ?>
  
</table>
    </div>
</div>
<?php
include "partials/footer.php";
?>