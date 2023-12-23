<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <?php  
           //check whether id is set or not in manage category to fetch the data from manage category to update category
           if(isset($_GET['id']))
           {
            //get the id and all other detail
            // echo "Getting the data";
            $id = $_GET['id'];
            //create sql query to create all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows to check whether the id is valid or not
            $count= mysqli_num_rows($res);

            if($count==1)
            {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else{
                //redirect to manage category 
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found!</div>";
                header('location:'.SITEURL.'admin/manage_category.php');
            }
        }
           else{
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage_category.php');
           }

          

        ?>
        <!-- multipart allow us to upload file from our device -->
       <form action="" method="POST" enctype="multipart/form-data"> 
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                   <?php
                       if($current_image!="")
                       {
                        //display the image
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                        <?php
                       }
                       else{
                        //display message error
                        echo "<div class='error'>Image Not Added</div>";
                       }
                   ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured =="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes

                    <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes

                <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

        <?php
             
             if(isset($_POST['submit']))
             {
                // echo "Clicked";
                //1. get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current__image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. updating new image if selected 
                //check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name = $_FILES['image']['name'];

                    //check whether the image is avaialble or not
                    if($image_name!="")
                    {
                        //image available
                    //A. upload the new image

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
                        header('location:'.SITEURL.'admin/manage_category.php');
                        //stop the process if we fail to upload the image then to stop the data to be inserted into database
                        die();

                    }
                    //B. remove the current image if available
                    if($current_image!="")
                    {
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);

                        //check whether the image is removed or not 
                        //if failed to removed then display message and stop the process
                        if($remove==false)
                        {
                           //failed to remove image
                           $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                           header('location:'.SITEURL.'admin/manage_category.php');
                           die();
                        }
                    }
                    }
                    
                   
                    else{
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }

                //3. update the database 
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //execute the query 
                $res2 = mysqli_query($conn, $sql2);

                //redirect to manage category with message 
                //check whether query executed or not
                if($res2==true)
                {
                    //category updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
                else{
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category!</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
            }
            
        
        ?>




    </div>
</div>
<?php include('partials/footer.php');?>
