<?php
include "partials_front/menu.php";
?>

<?php

//Check whether id is passed or not.
if(isset($_GET['category_id'])){
    $category_id=$_GET['category_id'];

    //Get category title based on category id.
    $sql="SELECT title FROM `tbl_category` WHERE id=$category_id ";

     //Execute the query
     $res=mysqli_query($conn,$sql);

     //Get the value from the database
     $rows=mysqli_fetch_assoc($res);

     //get the title
     $category_title=$rows['title'];


}else{
    //Catgeory not passed 
    //Redirect to home page


}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php  
        
        ?>
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //Create SQL Query to get foods based on selected category.
            $sql1="SELECT * FROM `tbl_food` WHERE category_id=$category_id ";

            //Execute the query
            $res1=mysqli_query($conn,$sql1);


            //Count rows to check whether the category is available or not.
            $count=mysqli_num_rows($res1);

            //Check whether food is available or not.
            if($count>0){
                while($rows1=mysqli_fetch_assoc($res1)){
                    $id=$rows1['id'];
                    $title=$rows1['title'];
                    $price=$rows1['price'];
                    $description=$rows1['description'];
                    $image_name=$rows1['image_name']; 
?>

                <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if($image_name==''){
                        //Display the message 
                        echo "<div class='error'>Image not Found</div>";
                    }else{
?>

                        <img  src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title ;?></h4>
                    <p class="food-price"><?php echo $price ;?></p>
                    <p class="food-detail">
                        <?php echo $description ;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id ;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>


<?php

                }
 
            }else{
                //Food not available
                echo "<div class='error'>Food not added. </div>";

            }


            
            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    
<?php
include "partials_front/footer.php";
?>