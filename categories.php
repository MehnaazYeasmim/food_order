<?php
include "partials_front/menu.php";
?>




    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
    <?php
    //Display all the categories that are active.
    $sql="SELECT * FROM `tbl_category`WHERE active='yes' ";

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
                            echo "<div class='error'>Image not Found</div>";
                        }else{
                            ?>
                            
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
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


    <?php
include "partials_front/footer.php";
?>