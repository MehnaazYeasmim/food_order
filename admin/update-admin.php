<?php
include "partials/menu.php";
?>

<div class="main_content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php

        //1. Get the id of admin to be updated 
        $id=$_GET['id'];

        //2. Create SQL Query to get Details
        $q="SELECT * FROM `tbl_admin` WHERE id=$id";

            //Execute the query
            $res=mysqli_query($conn,$q);

        //Check whether the query is executed or not
        if($res==true){
            $count=mysqli_num_rows($res);
            if($count==1){
                //Get the Details
                $rows=mysqli_fetch_assoc($res);

                $full_name=$rows['full_name'];
                $username=$rows['username'];

            }else{
                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        
        
        ?>
        <form action="" method='post'>
            <table class='tbl-30'>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ;?>"></td>
                </tr>
                <tr>

                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username ;?>"></td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <input type="hidden" name='id' value="<?php echo $id ;?> ">
                        <input type="submit" name='submit' value="Update Admin" class='btn-secondary'>
                    </td>
                </tr>

            </table>
        </form>

</div>
</div>
<?php
include "partials/footer.php";
?>


<?php
// Process the value from form and save in database

//Check whether the button is clicked or not
    if(isset($_POST['submit'])){
            //1.get the data from form

            echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
            $id=$_POST['id'];
            $full_name=$_POST['full_name'];
            $username=$_POST['username'];
            

            //2.SQL Query to update the data into database

            $sql="UPDATE `tbl_admin` SET `full_name`='$full_name',`username`='$username' WHERE `id`=$id";

            //3. Execute query and update data in database
            $query=mysqli_query($conn,$sql);

            
            //4. Check whether the(Query is Executed) data is updated.
            if($query==true){

                //Create a variable to display message
                $_SESSION['update']="<div class='success'>Admin Updated Successfully</div>";

                //Redirect Page to manange admin
                header('location:'.SITEURL.'admin/manage-admin.php');

            }else{
                //Create a variable to display message
                $_SESSION['update']="<div class='error'>Failed to  Update Admin</div>";

                //Redirect Page to Add admin
                header('location:'.SITEURL.'admin/add-admin.php');

            }


    }
?>
