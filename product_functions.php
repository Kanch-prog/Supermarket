<?php

require 'db.php';

// Define a Product class to manage product operations
class Product {
    private $pdo;         // PDO object for database interactions
    private $id;          // Product ID
    private $name;        // Product name
    private $price;       // Product price
    private $image;       // URL or path to product image
    private $category;    // Product category
    private $quantity;    // Product quantity in stock

    // Constructor to initialize the PDO object
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Setters for each property
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    // Method to add a new product to the database
    public function addProduct() {
        // Prepare SQL statement for insertion
        $sql = "INSERT INTO products (name, price, image, category, quantity) VALUES (:name, :price, :image, :category, :quantity)";
        $stmt = $this->pdo->prepare($sql);
        
        // Bind values to the SQL statement
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':price', $this->price);
        $stmt->bindValue(':image', $this->image);
        $stmt->bindValue(':category', $this->category);
        $stmt->bindValue(':quantity', $this->quantity);
        
        // Execute the statement and return the result
        return $stmt->execute();
    }

    // Method to update an existing product in the database
    public function updateProduct() {
        // Prepare SQL statement for updating
        $sql = "UPDATE products SET name = :name, price = :price, image = :image, category = :category, quantity = :quantity WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        
        // Bind values to the SQL statement
        $stmt->bindValue(':id', $this->id);
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':price', $this->price);
        $stmt->bindValue(':image', $this->image);
        $stmt->bindValue(':category', $this->category);
        $stmt->bindValue(':quantity', $this->quantity);
        
        // Execute the statement and return the result
        return $stmt->execute();
    }

    // Method to delete a product from the database
    public function deleteProduct() {
        // Prepare SQL statement for deletion
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        
        // Bind value to the SQL statement
        $stmt->bindValue(':id', $this->id);
        
        // Execute the statement and return the result
        return $stmt->execute();
    }

    // Static method to fetch all products from the database
    public static function fetchProducts($pdo) {
        // Prepare SQL statement for selection
        $sql = "SELECT * FROM products";
        $stmt = $pdo->prepare($sql);
        
        // Execute the statement and fetch all results
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Function to add a new product using the Product class
function addProduct($pdo, $name, $price, $image, $category, $quantity) {
    $product = new Product($pdo);
    $product->setName($name);
    $product->setPrice($price);
    $product->setImage($image);
    $product->setCategory($category);
    $product->setQuantity($quantity);
    return $product->addProduct();
}

// Function to update an existing product using the Product class
function updateProduct($pdo, $id, $name, $price, $image, $category, $quantity) {
    $product = new Product($pdo);
    $product->setId($id);
    $product->setName($name);
    $product->setPrice($price);
    $product->setImage($image);
    $product->setCategory($category);
    $product->setQuantity($quantity);
    return $product->updateProduct();
}

// Function to delete a product using the Product class
function deleteProduct($pdo, $id) {
    $product = new Product($pdo);
    $product->setId($id);
    return $product->deleteProduct();
}

// Function to fetch all products using the Product class
function fetchProducts($pdo) {
    return Product::fetchProducts($pdo);
}
?>
