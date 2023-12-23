<?php include('partials_frontend/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white text-bold">Confirm your order</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="images/menu-pizza.jpg" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3>Food Title</h3>
                        <p class="food-price color">Rs230</p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" min="1" class="input-responsive btn-secondary" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive btn-secondary" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive btn-secondary" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive btn-secondary" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="3" placeholder="" class="input-responsive btn-secondary" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-secondary">
                
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials_frontend/footer.php');?>