<?php
include "partials/menu.php";
?>

    <!-- Main Content Section Starts -->
    <div class="main_content">
        <div class="wrapper">

            <h1>DASHBOARD</h1>
            <br>
            <?php
        if(isset($_SESSION['login'])){
                echo $_SESSION['login'];//Displaying session message
                unset($_SESSION['login']);//Removing Session Message
            }

     ?> 
            <div class="col-4 text_center">
                <?php

                    $sql="SELECT * FROM `tbl_category`";

                    //Execute Query
                    $res=mysqli_query($conn,$sql);

                    $count=mysqli_num_rows($res);//Function to get whether we have categories



                ?>
                <h1><?php echo $count ;?></h1>
                Categories
            </div>
            <div class="col-4 text_center">
            <?php

                $sql2="SELECT * FROM `tbl_food`";

                //Execute Query
                $res2=mysqli_query($conn,$sql2);

                $count2=mysqli_num_rows($res2);//Function to get whether we have categories



                ?>
                <h1><?php echo $count2 ;?></h1>
                Foods
            </div>
            <div class="col-4 text_center">
            <?php

                $sql3="SELECT * FROM `tbl_order`";

                //Execute Query
                $res3=mysqli_query($conn,$sql3);

                $count3=mysqli_num_rows($res3);//Function to get whether we have categories



                ?>
                <h1><?php echo $count3 ;?></h1>
                Total Orders
            </div>
            <div class="col-4 text_center">
                <?php
                    //sql query to get total revenue generated
                    //Aggreate Function in SQL
                    $sql4="SELECT SUM(total) AS Total FROM `tbl_order` where status='Delivered' ";

                    //Execute Query
                    $res4=mysqli_query($conn,$sql4);

                    //Get the value
                    $rows4=mysqli_fetch_assoc($res4);
                    
                    //GET THE TOTAL REVENUE
                    $total_revenue=$rows4['Total'];




                ?>
                <h1><?php echo $total_revenue ;?></h1>
                Revenue Generated
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content Section Ends -->
<?php
include "partials/footer.php";
?>