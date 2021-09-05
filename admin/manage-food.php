<?php
include "partials/menu.php";
?>

<div class="main_content">
    <div class="wrapper">

        <h1>Manage Food </h1>
        <br>

        <?php

if(isset($_SESSION['add'])){
    echo $_SESSION['add'];//Displaying session message
    unset($_SESSION['add']);//Removing Session Message
}


if(isset($_SESSION['remove'])){
    echo $_SESSION['remove'];//Displaying session message
    unset($_SESSION['remove']);//Removing Session Message
}


if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];//Displaying session message
    unset($_SESSION['delete']);//Removing Session Message
}

if(isset($_SESSION['update1'])){
    echo $_SESSION['update1'];//Displaying session message
    unset($_SESSION['update1']);//Removing Session Message
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
            <a href="<?php echo SITEURL ; ?>admin/add-food.php" class='btn-primary'>Add Food</a>
            
            <br><br><br>

            <table class='tbl-full'>
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image_Name</th>
                    <th>Category_ID</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>


                </tr>
                <?php
                    //Query to get all category
                    $sql="SELECT * FROM `tbl_food`";
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
                                $description=$rows['description'];
                                $price=$rows['price'];
                                $image_name=$rows['image_name'];
                                $category_id=$rows['category_id'];
                                $featured=$rows['featured'];
                                $active=$rows['active'];

                                
                                //Display values in our table
                                ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $description;?></td>
                            <td><?php echo $price;?></td>


                            <td>
                                <?php 
                                    //Check whether image name is available or not 
                                    if($image_name!=""){
                                        //Display the image
                                        ?>
                                            <img src="<?php echo SITEURL ;?>/images/food/<?php echo $image_name ;?>" width="100px" >

                                        <?php
                                    }else{
                                        //Display the message
                                        echo " <div class='error'>Image not added</div>";
                                    }
                                ?>
                            </td>
                             
                            <td><?php echo $category_id;?></td>
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>

                            <td>
                                <a href="<?php echo SITEURL ;?>admin/update-food.php?id=<?php echo $id ;?>" class='btn-secondary'> Update Food</a>
                                <a href="<?php echo SITEURL ;?>admin/delete-food.php?id=<?php echo $id ;?>&image_name=<?php echo $image_name ;?>" class='btn-danger'> Delete Food</a>
                            </td>
                        </tr>
                        
                        <?php
                            }
                        }
                    else{
                        //we dont have data in database
                        
                        echo "<tr><td colspan='7' class='error'>Food not Added</td></tr>" ;
                        
                    }
                }
                    
                    ?>
            </table>
    </div>
</div>
<?php
include "partials/footer.php";
?>
