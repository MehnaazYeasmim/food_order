<?php
include "partials_front/menu.php";
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ;?>food_search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
     if(isset($_SESSION['order'])){
        echo $_SESSION['order'];//Displaying session message
        unset($_SESSION['order']);//Removing Session Message
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
               
            <?php 

            //Create sql query to display category from database
            $sql="SELECT * FROM `tbl_category`WHERE active='yes' AND featured='yes' LIMIT 3 ";

            //Execute the query
            $res=mysqli_query($conn,$sql);

            //Count rows to check whether the category is available or not.
            $count=mysqli_num_rows($res);

            if($count>0){
                //Get the Details
                while($rows=mysqli_fetch_assoc($res)){
                    $id=$rows['id'];
                    $title=$rows['title'];
                    $image_name=$rows['image_name'];
                    ?>
                <a href="<?php echo SITEURL ;?>category_foods.php?category_id=<?php echo $id;?>">
                    <div class="box-3 float-container">
                        <?php
                        //Check whether image is available or not
                        if($image_name==''){
                            //Display the message 
                            echo "<div class='error'>Image not Available</div>";
                        }else{
                            ?>
                            <img   src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title?></h3>
                    </div>
                </a>

                    <?php
                }

            }else{
                //Categories not available.
                echo "<div class='error'>Category not added. </div>";
            }


            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
             <?php
                 //Display all the foods that are active as well as featured
                $sql="SELECT * FROM `tbl_food`WHERE active='yes' AND featured='yes'";

                //Execute the query
                $res=mysqli_query($conn,$sql);

                //Count rows to check whether the foods is available or not.
                $count=mysqli_num_rows($res);
                if($count>0){
                    //Get the Details
                    while($rows=mysqli_fetch_assoc($res)){
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $price=$rows['price'];
                        $description=$rows['description'];
                        $image_name=$rows['image_name'];
                        ?>
                        <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if($image_name==''){
                        //Display the message 
                        echo "<div class='error'>Image not Found</div>";
                    }else{
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                        //Categories not available.
                        echo "<div class='error'>Food not added. </div>";
            
                    }
            
                ?>
                        
                        <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
    
<?php
include "partials_front/footer.php";
?>