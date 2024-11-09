<?php
require 'db.php';

class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function placeOrder($userId, $total) {
        // Insert the order into the orders table
        $sql = "INSERT INTO orders (user_id, total, order_date, status) VALUES (:user_id, :total, NOW(), 'Pending')";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':total', $total);
        
        if ($stmt->execute()) {
            return $this->pdo->lastInsertId(); // Get the last inserted order ID
        }
        return false;
    }

    public function addOrderItems($orderId, $cartItems) {
        // Insert the order items into the order_items table
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($cartItems as $productId => $product) {
            $stmt->bindValue(':order_id', $orderId);
            $stmt->bindValue(':product_id', $productId);
            $stmt->bindValue(':quantity', $product['quantity']);
            $stmt->bindValue(':price', $product['price']);
            $stmt->execute(); // Execute the insertion for each item
        }
    }

    public function processCheckout($userId) {
        if (!empty($_SESSION['cart'])) {
            $this->pdo->beginTransaction();
            try {
                // Calculate the total for the order
                $total = array_reduce($_SESSION['cart'], function($carry, $item) {
                    return $carry + ($item['price'] * $item['quantity']);
                }, 0);

                // Place the order and get the order ID
                $orderId = $this->placeOrder($userId, $total);
                if ($orderId) {
                    // Add order items to the order_items table
                    $this->addOrderItems($orderId, $_SESSION['cart']);
                    $this->pdo->commit();
                    unset($_SESSION['cart']); // Clear the cart after successful checkout
                    return true;
                }
            } catch (Exception $e) {
                $this->pdo->rollBack();
                error_log($e->getMessage());
            }
        }
        return false;
    }

    public function getUserOrders($userId) {
        $sql = "SELECT id, product_id, quantity, status FROM orders WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
