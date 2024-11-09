<?php
session_start();
require 'db.php';
require 'order_function.php';

$order = new Order($pdo);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_order'])) {
    $userId = 1; // Replace with the actual logic to get the user ID, e.g., from the session
    if ($order->processCheckout($userId)) {
        echo "Order placed successfully.";
    } else {
        echo "Failed to place the order.";
    }
}

?>
