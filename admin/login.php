<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System
        </title>
        <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    </head>
    <body class="color">
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="../images/logo.jpeg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
        </div>
    </section>
           <div class="login img">
           <h1 class="text-center">Login</h1>
            <br><br> 

            <?php
               if(isset($_SESSION['login']))
               {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
               }

               if(isset($_SESSION['no-login-message']))
               {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
               }


            ?>
            <br>
           <!-- login form starts here -->
            <form action="" method="POST" class="text-center font">
                Username:<br><br>
                <input type="text" name="username" placeholder="Enter username"><br><br>
                Password:<br><br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>


            </form>

           <!-- login form ends here -->
        </div>

    </body>
</html>

<?php

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        //1. Get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the query 
        $res = mysqli_query($conn, $sql);

        //4. count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user available and login success
            $_SESSION['login'] = "<div class='success'>Login Successful! </div>";
            //session to check whether the user is logged in or not and logout will unset it
            $_SESSION['user'] = $username;
            //redirect to Home page 
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available and login fail
            $_SESSION['login'] = "<div class='error'>Login Failed! Username or Password did not match. </div>";
            //redirect to Home page 
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>