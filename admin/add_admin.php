<?php include('partials/menu.php'); ?>
 

<div class="main-content">
        <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        
        <?php
        if(isset($_SESSION['add'])) //checking whether the session is set or not
        {
             echo $_SESSION['add'];  // display the session message 
             unset($_SESSION['add']); //removing the session message
        }
        ?>

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="full_name" placeholder="Enter your name">
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" placeholder="Enter your username">
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" placeholder="Enter your Password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-primary"> 
                </td>
               
            </tr>
        </table>
        </form>
        </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 



// process the value from form and save it in database

// check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //button clicked
    // echo "button clicked";

    //1. get the data from form
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']); //password encryption with md5

     //2. SQL Query to save thedata into database
     $sql = "INSERT INTO tbl_admin SET
     full_name = '$full_name',
     username = '$username',
     password = '$password'
     ";

    //3. Executing query and saving data into database
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    //4. Check whether the (Query is executed) data is inserted or not and display appropriate message
     if($res == true){
         //data inserted
        //  echo "Data inserted";
        //create a session variable to display message
        $_SESSION['add']  = "<div class='success'>Admin Added Successfully!!</div>";
        //Redireect Page to add admin
        header("location:".SITEURL.'admin/manage_admin.php');// .siteurl is the concatenation of the site with the admin manage page
    }
    else
    {
        //Failed to insert data
        // echo "Failed to insert data";
        //create a session variable to display message
        $_SESSION['add']  = "<div class='error'>Failed To Add Admin!</div>";
        //Redireect Page to add admin
        header("location:".SITEURL.'admin/add_admin.php'); // .siteurl is the concatenation of the site with the admin manage page
    }

}

?>