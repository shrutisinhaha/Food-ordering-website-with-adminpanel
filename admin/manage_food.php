<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
   <h1>Manage Food</h1>

   <br><br>

   <?php
       if(isset($_SESSION['add'])) //checking whether the session is set or not
       {
            echo $_SESSION['add'];  // display the session message 
            unset($_SESSION['add']); //removing the session message
       }

       if(isset($_SESSION['delete'])) //checking whether the session is set or not
       {
            echo $_SESSION['delete'];  // display the session message 
            unset($_SESSION['delete']); //removing the session message
       }

       if(isset($_SESSION['upload'])) //checking whether the session is set or not
       {
            echo $_SESSION['upload'];  // display the session message 
            unset($_SESSION['upload']); //removing the session message
       }
       if(isset($_SESSION['unauthorize'])) //checking whether the session is set or not
       {
            echo $_SESSION['unauthorize'];  // display the session message 
            unset($_SESSION['unauthorize']); //removing the session message

       }
       if(isset($_SESSION['remove'])) //checking whether the session is set or not
       {
            echo $_SESSION['remove'];  // display the session message 
            unset($_SESSION['remove']); //removing the session message
       }
       
       
       ?>
       <br><br>
        <!-- button to add admin -->
       <a href="<?php echo SITEURL;?>admin/add_food.php" class="btn-primary">Add Food</a> 
       <br><br><br>


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                
                //create a sql query to get all the food 
                $sql= "SELECT * FROM tbl_food";

                //execute the query
                $res = mysqli_query($conn,$sql);

                //count rows to check whether we have food or not
                $count=mysqli_num_rows($res);

                //create serial no. variable and set default value as 1
                $sn=1;

                if($count>0)
                {
                    // we have food in database
                    //get the food from dataabse and display 
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the value from individual columns
                        $id= $row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        ?>
                        <tr>
                             <td><?php echo $sn++;?></td>
                             <td><?php echo $title;?></td>
                             <td><?php echo $price;?></td>
                             <td>
                                <?php
                                  //check whether we have image or not 
                                  if($image_name=="")
                                  {
                                    //we dont have image display error message
                                    echo "<div class='error'>Image Not Added</div>";
                                  }
                                  else{
                                    //we have image, display image
                                    ?>
                                     <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px"> 
                                    <?php
                                  }
                                
                                ?>
                            </td>
                             <td><?php echo $featured;?></td>
                             <td><?php echo $active;?></td>
                             <td>
                             <a href="<?php echo SITEURL;?>admin/update_food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a> 
                             <a href="<?php echo SITEURL;?>admin/delete_food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                             </td>
                        </tr>


                        <?php

                    }
                }
                else{
                    //food not added in database 
                    echo "<tr><td colspan='7' class='error'>Food Not Added!</td></tr>";
                }
            ?>
        </table>
       
        
</div>
</div>


<?php include('partials/footer.php'); ?>