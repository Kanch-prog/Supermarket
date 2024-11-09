<?php
require 'db.php';
require 'user.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['registerUsername'];
        $email = $_POST['registerEmail'];
        $password = $_POST['registerPassword'];

        if (empty($username) || empty($email) || empty($password)) {
            User::setSessionMessage("All fields are required.");
            header('Location: index.php');
            exit();
        }

        $user = new User($pdo);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);

        if ($user->registerUser()) {
            $_SESSION['message'] = 'Registration successful!';
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['message'] = 'Registration failed. Please try again.';
            header('Location: index.php');
            exit();
        }
    }
}

?>
