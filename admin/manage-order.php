<?php
include "partials/menu.php";
?>

    <div class="main_content">
        <div class="wrapper">

        <h1>Manage Order </h1>
        <br>            
            
            <br><br><br>
            <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//Displaying session message
                unset($_SESSION['update']);//Removing Session Message
            }
            
            ?>

            <table class='tbl-full'>
                <tr>
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order   Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php
                    //Query to get all category
                    $sql="SELECT * FROM `tbl_order` order by id desc";
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
                                $food=$rows['food'];
                                $price=$rows['price'];
                                $quantity=$rows['quantity'];
                                $total=$rows['total'];
                                $order_date=$rows['order_date'];
                                $status=$rows['status'];
                                $customer_name=$rows['customer_name'];
                                $contact=$rows['customer_contact'];
                                $email=$rows['customer_email'];
                                $address=$rows['customer_address'];
                                

                                
                                //Display values in our table
                                ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $food;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $quantity;?></td>
                            <td><?php echo $total ;?></td>       
                            <td><?php echo $order_date;?></td>
                            <td>
                                <?php 
                                //Ordered , On Delivery , delivered , Cancelled
                                if($status=="Ordered")
                                {
                                    echo "<label> $status </label> ";
                                }else if($status=='On Delivery'){

                                    echo "<label style='color:orange '> $status </label>";

                                }else if($status=='Delivered'){

                                    echo "<label style='color:green '> $status </label>";

                                }else if($status=='Canceled'){
                                    echo "<label style='color:red '> $status </label>";
                                }
                                ?>
                            </td>

                            <td><?php echo $customer_name;?></td>
                            <td><?php echo $contact;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $address;?></td>
                            <td>
                                <a href="<?php echo SITEURL ;?>admin/update-order.php?id=<?php echo $id ;?>" class='btn-secondary'> Update Order</a>
                                <!-- <a href="<?php echo SITEURL ;?>admin/delete-food.php?id=<?php echo $id ;?>&image_name=<?php echo $image_name ;?>" class='btn-danger'> Delete Order</a> -->
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