<?php
require 'db.php';
require 'product_functions.php';
include 'header.php';



try {
    $products = fetchProducts($pdo);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Products</h2>

    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card product-card" style="width: 18rem; height: 30rem;">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" style="width: 100%; height: 50%;" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text">Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                            <p class="card-text">Category: <?php echo htmlspecialchars($product['category']); ?></p>
                            <p class="card-text">Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> 
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
