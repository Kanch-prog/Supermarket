<?php
require 'db.php';
require 'user.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            User::setSessionMessage("All fields are required.");
            header('Location: index.php');
            exit();
        }

        $user = new User($pdo);
        $user->setUsername($username);
        $user->setPassword($password);

        $userId = $user->authenticateUser();

        if ($userId) {
            $_SESSION['user_id'] = $userId;
            header('Location: index.php');
            exit();
        } else {
            User::setSessionMessage("Invalid username or password.");
            header('Location: index.php');
            exit();
        }
    }
}

?>
