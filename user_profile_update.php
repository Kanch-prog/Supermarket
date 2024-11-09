<?php
require 'db.php';
include 'header.php';

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

$message = []; 

if (isset($_POST['update'])) {
    $address = $_POST['address'];

    if (!empty($address)) {
        $update_profile = $pdo->prepare("UPDATE `users` SET address = ? WHERE id = ?");
        $update_profile->execute([$address, $user_id]);
    }

    // Password update logic
    $old_pass = $_POST['old_pass'];
    $previous_pass = md5($_POST['previous_pass']);
    $new_pass = md5($_POST['new_pass']);
    $confirm_pass = md5($_POST['confirm_pass']);

    if (!empty($previous_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        if ($previous_pass != $old_pass) {
            $message[] = 'Old password does not match!';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'New password does not match confirmation!';
        } else {
            $update_password = $pdo->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_password->execute([$confirm_pass, $user_id]);
            $message[] = 'Password has been updated!';
        }
    }

    $message[] = 'Your details have been updated successfully!';
}

$select_profile = $pdo->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// Ensure address key exists
$address = isset($fetch_profile['address']) ? htmlspecialchars($fetch_profile['address']) : '';
?>


<div class="container mt-4">
    <h2 class="mb-4">Update <span><?= htmlspecialchars($fetch_profile['username']); ?></span> Profile</h2>

    <form action="user_profile_update.php" method="post">
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" id="address" name="address" required class="form-control" placeholder="Enter your address" value="<?= htmlspecialchars($fetch_profile['address']); ?>">
        </div>
        
        <div class="mb-3">
            <input type="hidden" name="old_pass" value="<?= htmlspecialchars($fetch_profile['password']); ?>">
            <label for="previous_pass" class="form-label">Old Password:</label>
            <input type="password" id="previous_pass" class="form-control" name="previous_pass" placeholder="Enter previous password">
        </div>

        <div class="mb-3">
            <label for="new_pass" class="form-label">New Password:</label>
            <input type="password" id="new_pass" class="form-control" name="new_pass" placeholder="Enter new password">
        </div>

        <div class="mb-3">
            <label for="confirm_pass" class="form-label">Confirm Password:</label>
            <input type="password" id="confirm_pass" class="form-control" name="confirm_pass" placeholder="Confirm new password">
        </div>

        <button type="submit" name="update" class="btn btn-success">Update Profile</button>
        <a href="profile.php" class="btn btn-secondary">Go Back</a>
    </form>
</div>


