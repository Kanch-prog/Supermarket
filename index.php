<?php include 'header.php'; ?>

  <!-- Hero Section -->
  <div class="hero-section">
        <div class="container">
            <h1>Your Daily Needs</h1>
            <p>Grocery at Home</p>
            <a href="display_products.php" class="btn btn-success">Go to Shop</a>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="category-section">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2>Shop by Categories</h2>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-2 category-item" data-category="dairy">
                    <img src="images/dairy-products.png" class="img-fluid" alt="Dairy">
                    <h4>Dairy</h4>
                </div>
                <div class="col-md-2 category-item" data-category="food">
                    <img src="images/diet.png" class="img-fluid" alt="Food & Drinks">
                    <h4>Food & Drinks</h4>
                </div>
                <div class="col-md-2 category-item" data-category="beauty">
                    <img src="images/beauty.png" class="img-fluid" alt="Beauty">
                    <h4>Beauty Products</h4>
                </div>
                <div class="col-md-2 category-item" data-category="furniture">
                    <img src="images/furniture.png" class="img-fluid" alt="Furniture">
                    <h4>Home Furniture</h4>
                </div>
                <div class="col-md-2 category-item" data-category="appliances">
                    <img src="images/electric-appliance.png" class="img-fluid" alt="Electric Appliances">
                    <h4>Electric Appliances</h4>
                </div>
                <div class="col-md-2 category-item" data-category="cleaning">
                    <img src="images/cleaning.png" class="img-fluid" alt="Cleaning">
                    <h4>Cleaning</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="product-section">
        <div class="container">
            <div class="row text-center" id="productRow">
                <!-- Products will be updated dynamically -->
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-2 feature-item">
                    <i class="fas fa-truck fa-2x"></i>
                    <h5>Free Delivery</h5>
                </div>
                <div class="col-md-2 feature-item">
                    <i class="fas fa-smile fa-2x"></i>
                    <h5>99% Customer</h5>
                </div>
                <div class="col-md-2 feature-item">
                    <i class="fas fa-clock fa-2x"></i>
                    <h5>10 Days</h5>
                </div>
                <div class="col-md-2 feature-item">
                    <i class="fas fa-credit-card fa-2x"></i>
                    <h5>Payment</h5>
                </div>
                <div class="col-md-2 feature-item">
                    <i class="fas fa-phone fa-2x"></i>
                    <h5>24/7 Line</h5>
                </div>
            </div>
        </div>
    </div>

   <!-- Juice Section -->
    <div class="juice-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 image-container">
                    <img src="images/ad.jpg" class="img-fluid" alt="Grapes Juice">
                </div>
            </div>
        </div>
    </div>

    
    <!-- Newsletter Section -->
    <div class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Newsletter & Get Updates</h2>
                <form class="form-inline">
                    <input type="email" class="form-control" placeholder="Enter your email">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
 <!-- Footer -->
 <div class="footer">
        <div class="container">
            <p>&copy; 2024 Online Supermarket. All rights reserved.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="index.js"></script>
    </body>

</html>

