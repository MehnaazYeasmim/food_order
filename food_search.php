<?php
include "partials_front/menu.php";
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
                //Get the search keyword
                $search=$_POST['search'];

            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search ;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php


             //Display all the foods based on search keyword.
             $sql="SELECT * FROM `tbl_food` WHERE title Like '%$search%' OR description Like '%$search%'";

             //Execute the query
             $res=mysqli_query($conn,$sql);

             //Count rows to check whether the foods is available or not.
             $count=mysqli_num_rows($res);

             if($count>0){

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
                                echo "<div class='error'>Image not Available</div>";
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

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
                    </div>

                    <?php
                }

             }else{
                //Food not available.
                echo "<div class='error'>Food not available. </div>";
            
             }
            
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php
include "partials_front/footer.php";
?>
