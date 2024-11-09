<?php
require 'user.php';
require 'db.php';

session_start();

$error = '';

// Login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a User instance
    $user = new User($pdo);
    $user->setUsername($username);
    $user->setPassword($password);

    // Check if the user is an admin
    if (User::isAdmin($username, $password)) {
        // User is an admin, proceed to admin area
        $_SESSION['is_admin'] = true;
        header("Location: admin_dashboard.php");
        exit;
    }

    // Authenticate regular user
    if ($user->authenticateUser()) {
        $_SESSION['user_id'] = $user->authenticateUser();
        header("Location: user_dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 500px;
            margin: 50px auto;
        }
        .login-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .login-form h1 {
            margin-bottom: 20px;
        }
        .login-form .form-group label {
            font-weight: bold;
        }
        .login-form .btn {
            background-color: #007bff;
            border-color: #007bff;
        }
        .login-form .btn:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h1 class="text-center">Admin Login</h1>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
