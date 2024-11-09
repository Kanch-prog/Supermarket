<?php
session_start();
require 'db.php';
require 'Cart.php'; 

// Handle the POST request to add a product to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $cart = new Cart($pdo);

    if ($cart->addToCart($productId)) {
        header('Location: cart_display.php'); 
        exit;
    } else {
        echo "Product not found.";
    }
}
?>
