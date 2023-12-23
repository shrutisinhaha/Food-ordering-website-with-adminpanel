<?php include('partials/menu.php'); ?>

   <!-- Main Content Section Starts -->
   <div class="main-content">
        <div class="wrapper">
        <h1>ADMIN-PANEL</h1>
        <br>

        <?php
        if(isset($_SESSION['add'])) 
         {
             echo $_SESSION['add']; //displaying session message
             unset($_SESSION['add']); //removing session message
         }

        if(isset($_SESSION['delete']))
         {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
         }

         if(isset($_SESSION['update']))
         {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
         }
         if(isset($_SESSION['user-not-found']))
         { 
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
         }
         if(isset($_SESSION['password-not-matched']))
         { 
            echo $_SESSION['password-not-matched'];
            unset($_SESSION['password-not-matched']);
         }
         if(isset($_SESSION['change-password']))
         { 
            echo $_SESSION['change-password'];
            unset($_SESSION['change-password']);
         }
        ?> 
        <br><br><br>
        <!-- button to add admin -->
       <a href="add_admin.php" class="btn-primary">Add Admin</a> 
       <br><br><br>


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
               //Query to get all admin
               $sql = "SELECT * FROM tbl_admin";
               //Execute the query
               $res = mysqli_query($conn, $sql);

               //chck whether the query is executed or not
               if($res == true)
               {
                // Count rowsto check whether we have data in database or not
                $count = mysqli_num_rows($res); //function to get all the rows in database
                
                $sn=1; //create a variable and assign the value 
                //Check the num of rows 
                if($count>0)
                {
                    //WE have data in database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //using while loop to get all the data from database 
                        //and while loop will run as long as we have data in database

                        ////Get individual data 
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        //display the value in our table
            ?>
                    <tr>
                         <td><?php echo $sn++;?></td>
                         <td><?php echo $full_name;?></td>
                         <td><?php echo $username;?></td>
                         <td>
                             <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                             <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>"  class="btn-secondary">Update Admin</a> 
                             <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>"  class="btn-danger">Delete Admin</a>
                         </td>
                    </tr>  
                       
                    <?php
                    }
                }
            else
            {
                    //we do not have data in database
            }
            }
            ?>

            
        </table>
       
        
        </div>
   </div>
   <!-- Main Content Section Ends -->

   <?php include('partials/footer.php'); ?>
