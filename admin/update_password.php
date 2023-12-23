<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30 clearfix">
            <tr>
                <td colspan="2">Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="Current_Password">
                </td>
            </tr>
        

            <tr>
            <td colspan="2">New Password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="New_Password">
                </td>
            </tr>
    
            <tr>
            <td colspan="2">Confirm Password:</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm_Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
            
          </table>
          
        </form>
        
    </div>
</div>

<?php
        //check whther the submit button is clicked or not
        if(isset($_POST['submit']))
        {
           // echo "clicked";

           //1. Get the data from the form
           $id=$_POST['id'];
           $current_password = md5($_POST['current_password']);
           $new_password= md5($_POST['new_password']);
           $confirm_password = md5($_POST['confirm_password']);

           //2. Check whether the user with current id and current password exists or not
           $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'"; //id has an int value whereas password is a varchar so it needs single qoute

           //Execute the query
           $res=mysqli_query($conn, $sql);

           if($res==true)
           {
            //check whether the data is available or not
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //user exists and password can be changed 
               //echo "User Found";

               //Check whether the new password and confirm password match or not
               if($new_password==$confirm_password)
               {
                   //update the password
                  $sql2= "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                    ";

                    //Execute the query
                    $res2= mysqli_query($conn, $sql2);

                    //check whether the query is executed or not
                    if($res==true)
                    {
                        //display message
                        //Redirect to manage Admin Page with Error message
                        $_SESSION['change-password'] = "<div class='success'>Password Changed Successfully. </div>";
                        //redirect the user
                        header("location:".SITEURL.'admin/manage_admin.php');
  
                    }
                    else{
                        //display error message
                         //Redirect to manage Admin Page with Error message
                         $_SESSION['change-password'] = "<div class='error'>Failed To Change Password. </div>";
                         //redirect the user
                         header("location:".SITEURL.'admin/manage_admin.php');
   
                    }

               }
               else
               {
                  //Redirect to manage Admin Page with Error message
                  $_SESSION['password-not-matched'] = "<div class='error'>Password Not Matched. </div>";
                  //redirect the user
                  header("location:".SITEURL.'admin/manage_admin.php');
  
               }
                
            }
            else
            {
                //user does not exist. Set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                //redirect the user
                header("location:".SITEURL.'admin/manage_admin.php');

            }
           }

           
        }

?>





<?php include('partials/footer.php'); ?>