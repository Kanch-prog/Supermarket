<?php
include 'header.php';
require 'Cart.php';
require 'order_function.php';

$cart = new Cart($pdo);
$cartItems = $cart->getCartItems();
$grandTotal = $cart->calculateTotal();
?>

<div class="container mt-4">
    <h2>Your Cart</h2>
    <?php if (!empty($cartItems)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $productId => $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>$<?php echo number_format($product['price'], 2); ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td>$<?php echo number_format($product['price'] * $product['quantity'], 2); ?></td>
                        <td>
                            <form action="update_cart.php" method="POST" class="d-inline">
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form action="remove_from_cart.php" method="POST" class="d-inline">
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td><strong>$<?php echo number_format($grandTotal, 2); ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-success" id="proceedToCheckoutBtn">Proceed to Checkout</button>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="confirmOrderModal" tabindex="-1" role="dialog" aria-labelledby="confirmOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmOrderModalLabel">Confirm Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to confirm the order of <strong>$<?php echo number_format($grandTotal, 2); ?></strong>?</p>
            </div>
            <div class="modal-footer">
                <form action="checkout.php" method="POST" id="confirmOrderForm">
                    <input type="hidden" name="confirm_order" value="1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById('proceedToCheckoutBtn').addEventListener('click', function() {
        $('#confirmOrderModal').modal('show');
    });

    document.getElementById('confirmOrderForm').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch('checkout.php', {
            method: 'POST',
            body: new URLSearchParams(new FormData(this)),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => response.text())
        .then(data => {
            // Handle response, like redirecting or showing success message
            alert('Order placed successfully!');
            
            // After the alert is closed, reload the page
            setTimeout(() => {
                location.reload();
            }, 1000); 
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>

