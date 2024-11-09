<?php
require 'db.php';
include 'header.php';


$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

      $select_profile = $pdo->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_profile->execute([$user_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-4">
    <h2 class="mb-4"> <span><?= htmlspecialchars($fetch_profile['username']); ?></span> Profile Page </h2>

    <section class="profile-container">
        <div class="profile">
            <p>Username: <?= htmlspecialchars($fetch_profile['username']); ?></p>
            <p>Email: <?= htmlspecialchars($fetch_profile['email']); ?></p>
            <p>Password: <?= htmlspecialchars($fetch_profile['password']); ?></p>
            <button type="button" class="btn btn-info">
                <a href="user_profile_update.php" class="btn">Update Profile</a>
            </button>
        </div>
    </section>
</div>
