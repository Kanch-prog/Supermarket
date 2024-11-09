<?php
session_start();
require 'db.php';
require 'Cart.php';

$cart = new Cart($pdo);

// Check if the request method is POST and contains product_id
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Remove the item from the cart
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        // Optionally set a success message or redirect
        header('Location: cart_display.php'); // Redirect back to cart display
        exit();
    }
}

// If there are no valid removals, redirect back to the cart
header('Location: cart_display.php');
exit();
?>
