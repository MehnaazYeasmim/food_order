<?php
include "partials/menu.php";
?>
<div class="main_content">
    <div class="wrapper">
        <h1>Add Admin</h1>
<br><br>
<?php
if(isset($_SESSION['add'])){    //Checking whether the session is set or not
    echo $_SESSION['add'];  //Displaying the session message if set
    unset($_SESSION['add']);    //Remove the session message
}
?>
        <form action="" method='post'>
            <table class='tbl-30'>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder='Enter your Name'></td>
                </tr>
                <tr>

                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder='Enter your Username'></td>
                </tr>
                <tr>

                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder='Enter your Password'></td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <input type="submit" name='submit' value="Add Admin" class='btn-secondary'>
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

            $full_name=$_POST['full_name'];
            $username=$_POST['username'];
            $password=md5($_POST['password']);//Password encryption with MDN5 .

            //2.SQL Query to save the data into database

            $sql="INSERT INTO `tbl_admin`( `full_name`,`username`,`password`) VALUES ('$full_name','$username','$password')";

            //3. Execute query and save data in database
            $query=mysqli_query($conn,$sql) or die(mysqli_error());

            
            //4. Check whether the(Query is Executed) data is inserted or not and display appripriate message 
            if($query==true){

                //Create a variable to display message
                $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";

                //Redirect Page to manange admin
                header('location:'.SITEURL.'admin/manage-admin.php');

            }else{
                //Create a variable to display message
                $_SESSION['add']="<div class='error'>Failed to  Add Admin</div>";

                //Redirect Page to Add admin
                header('location:'.SITEURL.'admin/add-admin.php');

            }


    }
?>
