<?php
session_start();
require 'db.php';
require 'Cart.php';

$cart = new Cart($pdo);

// Check if the request method is POST and contains product_id and quantity
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Update the quantity in the cart
    if ($cart->updateQuantity($productId, $quantity)) {
        // Optionally set a success message or redirect
        header('Location: cart_display.php'); // Redirect back to cart display
        exit();
    }
}

// If there are no valid updates, redirect back to the cart
header('Location: cart_display.php');
exit();
?>
