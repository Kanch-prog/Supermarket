<?php
// Database connection parameters
$host = 'localhost'; // The hostname of the database server
$db = 'grocery_db';  // The name of the database to connect to
$user = 'root';      // The database username
$pass = '12345678K';          // The database password 

// DSN specifying 
$dsn = "mysql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
