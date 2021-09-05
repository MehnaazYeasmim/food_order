<?php
include "partials/menu.php";
?>

<div class="main_content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
<?php
        //check if id is set or not
        if(isset($_GET['id'])){
    
        //1. Get the id of admin to be updated 
        $id=$_GET['id'];
    
        //2. Create SQL Query to get Details
        $q="SELECT * FROM `tbl_order` WHERE id=$id";

        //Execute the query
        $res=mysqli_query($conn,$q);

        if($res==true){
            $count=mysqli_num_rows($res);
            if($count==1){
                        
            //Get the Details
            $rows=mysqli_fetch_assoc($res);


            $id=$rows['id'];
            $food=$rows['food'];
            $price=$rows['price'];
            $quantity=$rows['quantity'];
            $status=$rows['status'];
            $customer_name=$rows['customer_name'];
            $customer_contact=$rows['customer_contact'];
            $email=$rows['customer_email'];
            $address=$rows['customer_address'];
            

            }else{
                
                    //Create a variable to display message
                    $_SESSION['no-category-found']="<div class='error'>Order not Found .</div>";
    
                    //Redirect Page to manage catgeory
                    header('location:'.SITEURL.'admin/manage-order.php');
                
            }
            
        }
        

        }else{
             //Redirect Page to manage order page
             header('location:'.SITEURL.'admin/manage-order.php');
        }
?>

    <form action="" method="post" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Food Name:</td>
                    <td ><b><?php echo $food ;?></b.</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b>$<?php echo $price ;?></b></td>
                </tr>
                <tr>
                    <td>Qty:</td>
                    
                    <td><input type="number" name="qty"  value="<?php echo $quantity ;?>"></td>

                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected " ;} ?>  value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected " ;} ?>  value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected " ;} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Canceled"){echo "selected " ;} ?> value="Canceled">Canceled</option>
                        </select>
                    </td>
                </tr>

                <tr> 
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name ;?>">
                    </td>
                </tr>

                
                <tr> 
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_conatct" value="<?php echo $customer_contact ;?>">
                    </td>
                </tr>

                
                <tr> 
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $email ;?>">
                    </td>
                </tr>

                <tr> 
                    <td>Customer Address</td>
                    <td>
                        <textarea type="text" name="customer_address" cols=30 rows=5><?php echo $address ;?></textarea>
                    </td>
                </tr>

            

                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id ;?>">
                        <input type="hidden" name="price" value="<?php echo $price ;?>">
                        <input type="submit" name="submit" value="Update Order" class='btn-secondary'>
                    </td>
                </tr>

                


            </table>
        </form>

        <?php
// Process the value from form and save in database

//Check whether the Update  button is clicked or not
    if(isset($_POST['submit'])){
        //1.get the data from form
        
        
        
            

            // echo $category_id;
            // die();

            $id=$_POST['id'];
            
            $price=$_POST['price'];
            $quantity=$_POST['qty'];

            $total=$price*$quantity;

            $status=$_POST['status'];
            $customer_name=$_POST['customer_name'];
            $customer_contact=$_POST['customer_contact'];
            $email=$_POST['customer_email'];
            $address=$_POST['customer_address'];

            

            
        
        
            //2.SQL Query to update the data into database
            

            
            $sql="UPDATE `tbl_order` SET `quantity`=$quantity,`total`=$total,`status`='$status',`customer_name`='$customer_name',
            `customer_contact`='$customer_contact',`customer_email`='$email',`customer_address`='$address' WHERE id=$id";
            // $sql="UPDATE `tbl_category` SET `title`='$title',`featured`='$featured',`active`='$active' WHERE `id`=$id";
            

            //3. Execute query and update data in database
            $query=mysqli_query($conn,$sql);
            
            
            //4. Check whether the(Query is Executed) data is updated.
            if($query==true){
                
                
                //Create a variable to display message

                $_SESSION['update']="<div class='success'>Order Updated Successfully</div>";
                //Redirect Page to manange category
                header('location:'.SITEURL.'admin/manage-order.php');

            }else{
                
                //Create a variable to display message
                $_SESSION['update']="<div class='error'>Failed to  Update Order</div>";

                //Redirect Page to manage category
                header('location:'.SITEURL.'admin/manage-order.php');

            }
        }


    
?>

    
</div>
</div>

<?php
include "partials/footer.php";
?>
