<?php include('partials/menu.php');?>


    <!-- Main Content Section Starts -->
    <div class="main_content">
        <div class="wrapper">

            <h1>Manage Admin</h1>
            <br><br>
            <?php 
            //
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//Displaying session message
                unset($_SESSION['add']);//Removing Session Message
            }
            
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//Displaying session message
                unset($_SESSION['delete']);//Removing Session Message
            }

            
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//Displaying session message
                unset($_SESSION['update']);//Removing Session Message
            }

            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];//Displaying session message
                unset($_SESSION['user-not-found']);//Removing Session Message
            }

            
            if(isset($_SESSION['pwd-not-match'])){
                echo $_SESSION['pwd-not-match'];//Displaying session message
                unset($_SESSION['pwd-not-match']);//Removing Session Message
            }

            if(isset($_SESSION['change-pwd'])){
                echo $_SESSION['change-pwd'];//Displaying session message
                unset($_SESSION['change-pwd']);//Removing Session Message
            }

                ?>
                <br><br><br>
            <!-- Button to add Admin -->
            <!-- <button class='btn-primary'><a href="#">Add Admin</a></button> -->
            <a href="add-admin.php" class='btn-primary'>Add Admin</a>
            
            <br><br><br>

            <table class='tbl-full'>
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php
                    //Query to get all admin
                    $sql="SELECT * FROM `tbl_admin`";
                    //Execute the query
                    $res=mysqli_query($conn,$sql);

                    //Check whether the query is executed or not

                    if($res==TRUE){
                        //Count rows to check whether we have data in database or not
                        $count=mysqli_num_rows($res);//Function to get all the rows in database
                        $sn=1;//Create a variable and assign a value
                        if($count>0){
                            //We have data in database
                            while($rows=mysqli_fetch_assoc($res)){
                                //Using while loop to fetch all data from the database
                                //And while loop will run as long as we will have data in the database

                                //Get indivudial data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //Display values in our table
                                ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $full_name;?></td>
                            <td><?php echo $username;?></td>
                            <td>
                                <a href="<?php echo SITEURL ; ?>admin/update-password.php?id=<?php echo $rows['id'] ; ?>" class='btn-primary' >Change Password</a>
                                <a href="<?php echo SITEURL ; ?>admin/update-admin.php?id=<?php echo $rows['id'] ; ?>" class='btn-secondary' >Update Admin</a>
                                <a href="<?php echo SITEURL ; ?>admin/delete-admin.php?id=<?php echo $rows['id'] ; ?>" class='btn-danger' >Delete Admin</a>
                            </td>
                        </tr>

                    <?php
                            }
                        }
                    }else{
                        //we dont have data in database
                    }

                ?>
                          </table>
            
        </div>
    </div>
    <!-- Main Content Section Ends -->
<?php
include "partials/footer.php";
?>