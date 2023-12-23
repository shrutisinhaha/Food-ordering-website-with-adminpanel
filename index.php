<?php include('partials_frontend/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.."required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //create sql query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

                //execute the query
                $res = mysqli_query($conn,$sql);
                //count the rows to check whether the category is available or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    //categories available 
                    //use while to display all categories
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like id title and imagename
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                            <a href="category-foods.html">
                            <div class="box-3 float-container">
                                <?php 
                                //checking whether image is available or not
                                  if($image_name=="")
                                  {
                                    //diaply the message
                                    echo "<div class='error'>Image not Available!</div>";
                                  }
                                  else
                                  {
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Menu" class="img-responsive img-curve">
                                    <?php
                                  }
                                ?>
                            
                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                            </a>


                        <?php
                    }
                }
                else{
                    //CATEGORIES NOT AVAIALBLE
                    echo "<div class='error'>Categories Not Added!!</div>";
                }
            
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/chillichicken.jpeg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chilli Chicken</h4>
                    <p class="food-price">Rs.249</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/chickentikka.jpeg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chicken Tikka</h4>
                    <p class="food-price">Rs.249</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/chillichicken.jpeg" alt="Chicke Hawain Burger" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Tawa Chicken</h4>
                    <p class="food-price">Rs.249</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/chickentikka.jpeg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chicken Seekh Kabab</h4>
                    <p class="food-price">Rs.249</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/tandoorichicken.jpeg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Tandoori Chicken</h4>
                    <p class="food-price">Rs.249</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/chickentangdi.jpeg" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chicken Tangdi</h4>
                    <p class="food-price">Rs.249</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center back-color">
            <a href="foods.php" class="back-color hover">See All Foods</a>
    </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials_frontend/footer.php'); ?>