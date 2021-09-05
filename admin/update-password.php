<?php
include "partials/menu.php";
?>

<div class="main_content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
<?php

if(isset($_GET['id'])){
    $id=$_GET['id'];

}
?>
        <form action="" method='post'>
            <table class='tbl-30'>
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>

                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td>Confirm password</td>
                    <td><input type="password" name='confirm_password' placeholder="Confirm Password"></td>
                </tr>

                <tr>
                    <td class="colspan-2">
                        <input type="hidden" name='id' value="<?php echo $id ;?> ">
                        <input type="submit" value="Change Password" name="submit" class='btn-secondary'>
                    </td>
                    
                </tr>

            </table>
        </form>

</div>
</div>

</div>
</div>


<?php
include "partials/footer.php";
?>


<?php

//Check whether the change password button is clicked or not
if(isset($_POST['submit'])){
    //1.get the data from form

    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);
    

    //2. Check whether the user with current ID and password Exists or not.
    $sql="SELECT * FROM `tbl_admin` WHERE `id`=$id AND `password`='$current_password'";


    //Execute the query
    $res=mysqli_query($conn,$sql);


    //Check whether the query is executed or not
    if($res==true){
        $count=mysqli_num_rows($res);
        

            if($count==1){
                 
                // Check whether the new password and Confirm Password match or not
                if($new_password==$confirm_password){

                    //Update the Password
                    $sql2="UPDATE `tbl_admin` SET `password`='$new_password' WHERE `id`=$id";

                    //Execute the Query
                    $res2=mysqli_query($conn,$sql2);

                    //Check whether the query is executed or not
                    if($res2==true){
                        //Display Success message



                        //Redirect to amnage admin page with error message
                        $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully</div>";
                        //Redirect User 
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }else{
                        //Display Error message

                        //Redirect to amnage admin page with error message
                        $_SESSION['change-pwd']="<div class='error'>Failed to Change Password</div>";
                        //Redirect User 
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }
    





                }else{
                    //Redirect to amnage admin page with error message
                    $_SESSION['pwd-not-match']="<div class='error'>Password did not match</div>";
                    //Redirect User 
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }else{
                //User doesnot exist set message and redirect
                $_SESSION['user-not-found']="<div class='error'>User Not Found</div>";

                //Redirect User 
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
            
    }


    //3. Check whether the new password and Confirm Password match or not

    //4. Change password if all above is true.
            
}
?>