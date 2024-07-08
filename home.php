<?php

include 'db.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel = "stylesheet" href = "homeStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap"
         rel="stylesheet">
</head>
<body>
<div class="container">

    <div class="profile">
        <?php
            $select = mysqli_query($con, "SELECT * FROM `users` WHERE id = '$user_id'")
            or die('query failed');
            if(mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
                $fullName = $fetch['firstName'] . ' ' . $fetch['lastName'];
            }
            if ($fetch['image'] == '') {
                echo '<img src="/images/defaultprofile.jpg">';
            } else {
                echo '<img src="uploaded_img/' . $fetch['image'] . '">';
            }
        ?>
        <h3><?php echo $fullName; ?></h3>
        <a href="update_profile.php" class = "btn">Update Profile</a>
        <a href="home.php?logout=<?php echo $user_id; ?> " class = "btn">Logout</a>
        <p>new <a href="login.php">Login</a> or <a href="signup.php">Sign Up</a></p>
    </div>
</div>
</body>
</html>