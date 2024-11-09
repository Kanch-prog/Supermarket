<?php
require 'db.php';

// Handle user deletion
if (isset($_GET['delete'])) {
    $userId = intval($_GET['delete']);

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);

        // Set a session message for deletion success
        $_SESSION['message'] = 'User deleted successfully!';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Error deleting user: ' . $e->getMessage();
    }

    // Redirect back to the same page to refresh the user list
    header("Location: admin_dashboard.php?section=user_management");
    exit;
}

// Fetch users for display
$query = $pdo->query("SELECT * FROM users");

// Check for session messages
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<div class="container mt-4"> 
<h2>User Management</h2>

<!-- Display session messages -->
<?php if ($message): ?>
    <div class="alert alert-info">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<!-- Table to display users -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td>
                <a href="admin_dashboard.php?section=user_management&delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>


</div>
        