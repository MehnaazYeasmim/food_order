<?php
include "partials_front/menu.php";
?>
<?php

//Check whether id is passed or not.
if(isset($_GET['food_id'])){
    $food_id=$_GET['food_id'];

    //Get category title based on category id.
    $sql="SELECT * FROM `tbl_food` WHERE id=$food_id ";

     //Execute the query
     $res=mysqli_query($conn,$sql);

     //Count rows 
     $count=mysqli_num_rows($res);
     if($count==1){

         //Get the value from the database
         $rows=mysqli_fetch_assoc($res);

         $title=$rows['title'];
         $price=$rows['price'];                 
        $image_name=$rows['image_name'];

     }else{
        //Food not available 
        //Redirect to home page
        header('location:'.SITEURL);    
     }


     //get the title
     $category_title=$rows['title'];


}else{
    //Catgeory not passed 
    //Redirect to home page
    header('location:'.SITEURL);


}
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method='POST'>
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?php echo $title ;?></h3>
                        <input type='hidden' name='food' value='<?php echo $title;?>'>

                        <p class="food-price"><?php echo $price;?></p>
                        <input type="hidden" name='price' value='<?php echo $price ;?>'>
                        
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            //Check whether the submit button is clicked or not
                if(isset($_POST['submit'])){


                    //1.get the data from form
                    // $id=$_POST['id'];
                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price*$qty;
                    $order_date=date('Y-m-d h:i:sa');//Order date
                    $status='Ordered';//Ordered, On delivery , Delivered , Canceled, last 3 status will be maintained by admin.
                    $coustomer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];


                    //2. Save the order in data base
                    // SQL Query to update the data into database
            

                    // $sql2="INSERT INTO 'tbl_order' food='$food' , price=$price , qty=$qty ,total=$totals, order_date='$order_date', 
                    // status='$status', customer_name='$coustomer_name' , customer_contact='$customer_contact', customer_email='$customer_email'
                    // customer_address='$customer_address'";
                    $sql2="INSERT INTO `tbl_order`( `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`,
                     `customer_contact`, `customer_email`, `customer_address`)
                    VALUES ('$food','$price','$qty','$total','$order_date','$status','$coustomer_name','$customer_contact','$customer_email',
                    '$customer_address')";

                    // echo $sql2;
                    // die();

                    
                    
                    // Execute query and update data in database
                    $query=mysqli_query($conn,$sql2);

                    //4. Check whether the(Query is Executed) data is updated.
                    if($query==true){
                        // echo $query;
                        // die();
    

                        //Create a variable to display message

                        $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully</div>";
                        //Redirect 
                        header('location:'.SITEURL);

                    }else{
                        // echo $query;
                        // die();
    

                        $_SESSION['order']="<div class='error text-center'> Failed to order food </div>";
                        //Redirect 
                        header('location:'.SITEURL);

                    }



        

                    


                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
include "partials_front/footer.php";
?>