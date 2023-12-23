<?php
    
    //include constants.php file here
    include('../config/constants.php');


    //1. Get the id of the admin to be deleted 
    $id = $_GET['id'];

    //2.Create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed seccessfully or not
    if($res == true)
    {
         //query executed successfully and admin deleted
        //  echo "Admin Deleted";
        //Create sessio variable to display message 
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully!!</div>";
        //Redirect to manage admin page
        header("location:".SITEURL.'admin/manage_admin.php');
    }
    else{
        //failed to delete admin
        // echo "Failed to delete admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again later!</div>";
        header("location:".SITEURL.'admin/manage_admin.php');
    }
    

?>