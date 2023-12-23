<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])) //checking whether the session is set or not
        {
             echo $_SESSION['add'];  // display the session message 
             unset($_SESSION['add']); //removing the session message
        }
        if(isset($_SESSION['upload'])) 
        {
             echo $_SESSION['upload'];  
             unset($_SESSION['upload']); 
        }
        ?>

        <br><br>

        <!-- Add category form starts -->
        
        <!-- multipart allow us to upload file from our device -->

        <form action="" method="POST" enctype="multipart/form-data">     

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                <input type="text" name="title" placeholder="Category Title">
                </td>
             </tr>
             <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
             </tr>
            <tr>
                <td>Featured:</td>
                <td>
                 <input type="radio" name="featured" value="Yes">Yes
                 <input type="radio" name="featured" value="No">No
                </td>
                </tr>
            <tr>
               <td>Active:</td>
               <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
               </td>
           </tr>
           <tr>
               <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-primary">
               </td>
           </tr>
        </table>
        </form>
        </div>
</div>
<?php include('partials/footer.php');?>
       
         <!-- Add category form ends -->




            <?php
            //check whether the submit button is clciked or not
            if(isset($_POST['submit']))
             { 
                // echo "clicked";

                //1. Get the value from Category form
                 $title = $_POST['title'];
                

                //for radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                { 
                    //Get the value from form
                    $featured = $_POST['featured'];
                    

                }
                else{
                    //Set the default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                   
                }
                else
                { 
                    $active = "No";
                }

                //check whetherr the image is selected or not and set the value for image name accordingly
                //print_r($_FILES['image']);  //$_files is array and we have used print_r coz echo does not display the value of array

                //die(); //Break the code here coz i want to just see the value selected 

                if($_FILES['image']['name']!="")
                {
                    //uplaod the image 
                    //to upload image we need image name and source path and destination path
                    $image_name=$_FILES['image']['name'];

                    //Auto rename our image 
                    //Get the extension of our image(jpg,png,gif,etc) e.g. "food1.jpg"
                    $ext = end(explode('.',$image_name));

                    //rename the image
                    $image_name= "Food_Category_".rand(000,999).'.'.$ext; //Food_Category_446.jpg

                    $source_path=$_FILES['image']['tmp_name'];

                    $destination_path="../images/category/".$image_name; //to concatenate the image


                    

                    //finally upload the image 
                    $upload= move_uploaded_file($source_path, $destination_path);

                    //check whether the image is upoaded or not
                    //and if the image is not uploaded then we will stop the process and redirect with error messsage
                    if($upload==false)
                    {
                        //set message 
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        //redirect to add category page
                        header('location:'.SITEURL.'admin/add_category.php');
                        //stop the process if we fail to upload the image then to stop the data to be inserted into database
                        //die();

                    }
                }
                else{
                    //dont upload image and set the image name value as blank
                    $image_name="";
                }

                //2. Create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3. Execute the queery and save in database
                $res = mysqli_query($conn,$sql);

                //4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                   //Query executed and category added
                    $_SESSION['add'] = "Category Added Successfully.";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage_category.php');
                   
                }
                else{
                    //failed to add category
                    $_SESSION['add'] = "failed to Add Category.";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/add_category.php');
                    
                }
           } 


           
        
           
           ?>
            
         
            


        
   




    
