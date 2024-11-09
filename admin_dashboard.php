<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: admin_login.php");
    exit;
}

require 'db.php';

// Check if 'section' is set in the GET parameters
if (isset($_GET['section'])) {
    $section = $_GET['section'];
} else {
    // If 'section' is not set, default to 'order_management'
    $section = 'order_management';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #14A44D;
            padding-top: 20px;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .list-group-item-action {
            background-color: #28a745; 
            color: white; 
        }

        .list-group-item-action.active {
            background-color: #218838; 
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Admin Dashboard</h4>
        <div class="list-group">
            <a href="admin_dashboard.php?section=order_management" class="list-group-item list-group-item-action <?php echo $section === 'order_management' ? 'active' : ''; ?>">Order Management</a>
            <a href="admin_dashboard.php?section=product_management" class="list-group-item list-group-item-action <?php echo $section === 'product_management' ? 'active' : ''; ?>">Product Management</a>
            <a href="admin_dashboard.php?section=user_management" class="list-group-item list-group-item-action <?php echo $section === 'user_management' ? 'active' : ''; ?>">User Management</a>
            <a href="admin_logout.php" class="list-group-item list-group-item-action text-danger">Logout</a> 
        </div>
    </div>

    <div class="content">
        <?php
        // Load the appropriate section
        switch ($section) {
            case 'order_management':
                include 'order_management.php';
                break;
            case 'product_management':
                include 'product_management.php';
                break;
            case 'user_management':
                include 'user_management.php';
                break;
            default:
                echo '<h2>Welcome to the Admin Dashboard</h2>';
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
