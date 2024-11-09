<?php
require 'db.php';
require 'product_functions.php';


$error = '';
$success = '';

try {
    $products = fetchProducts($pdo);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Adding a new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];

    if (!empty($name) && !empty($price) && !empty($image) && !empty($category)) {
        try {
            if (addProduct($pdo, $name, $price, $image, $category, $quantity)) {
                $success = 'Product added successfully!';
            } else {
                $error = 'Failed to add product!';
            }
        } catch (PDOException $e) {
            $error = 'Error: ' . $e->getMessage();
        }
    } else {
        $error = 'Please fill in all required fields!';
    }
}

// Updating a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];

    if (!empty($name) && !empty($price) && !empty($image) && !empty($category)) {
        try {
            if (updateProduct($pdo, $id, $name, $price, $image, $category, $quantity)) {
                $success = 'Product updated successfully!';
            } else {
                $error = 'Failed to update product!';
            }
        } catch (PDOException $e) {
            $error = 'Error: ' . $e->getMessage();
        }
    } else {
        $error = 'Please fill in all required fields!';
    }
}

// Deleting a product
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    try {
        if (deleteProduct($pdo, $id)) {
            $success = 'Product deleted successfully!';
        } else {
            $error = 'Failed to delete product!';
        }
    } catch (PDOException $e) {
        $error = 'Error: ' . $e->getMessage();
    }
}

// Fetching products for display
try {
    $products = fetchProducts($pdo);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Product Management</h2>

    <!-- Display error or success messages -->
    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <!-- Form to add a new product -->
    <form method="POST" class="mb-4">
        <input type="hidden" name="action" value="add">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL:</label>
            <input type="text" id="image" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Add Product</button>
    </form>

    <!-- Table to display products -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100"></td>
                        <td><?php echo htmlspecialchars($product['category']); ?></td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td>
                            <!-- Update Form Trigger -->
                            <button class="btn btn-primary" onclick="showUpdateForm(<?php echo htmlspecialchars($product['id']); ?>, '<?php echo htmlspecialchars($product['name']); ?>', <?php echo htmlspecialchars($product['price']); ?>, '<?php echo htmlspecialchars($product['image']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', <?php echo htmlspecialchars($product['quantity']); ?>)">Update</button>
                            <!-- Delete Button -->
                            <a href="?delete_id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Form to update a product -->
    <form method="POST" id="updateForm" class="mb-4" style="display: none;">
        <input type="hidden" name="action" value="update">
        <input type="hidden" id="update_id" name="id">
        <div class="form-group">
            <label for="update_name">Product Name:</label>
            <input type="text" id="update_name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="update_price">Price:</label>
            <input type="number" id="update_price" name="price" step="0.01" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="update_image">Image URL:</label>
            <input type="text" id="update_image" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="update_category">Category:</label>
            <input type="text" id="update_category" name="category" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="update_quantity">Quantity:</label>
            <input type="number" id="update_quantity" name="quantity" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning">Update Product</button>
        <button type="button" class="btn btn-secondary" onclick="hideUpdateForm()">Cancel</button>
    </form>
</div>
<!-- showUpdateForm -->
<script>
    function showUpdateForm(id, name, price, image, category, quantity) {
        document.getElementById('update_id').value = id;
        document.getElementById('update_name').value = name;
        document.getElementById('update_price').value = price;
        document.getElementById('update_image').value = image;
        document.getElementById('update_category').value = category;
        document.getElementById('update_quantity').value = quantity;
        document.getElementById('updateForm').style.display = 'block';
    }

    function hideUpdateForm() {
        document.getElementById('updateForm').style.display = 'none';
    }
</script>
