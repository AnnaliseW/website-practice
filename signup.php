<?php
    session_start();
    include("db.php"); // Ensure db.php includes your database connection

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = mysqli_real_escape_string($con, $_POST['user_name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $fName = mysqli_real_escape_string($con, $_POST['firstName']);
        $lName = mysqli_real_escape_string($con, $_POST['lastName']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;
        if (!empty($email) && !empty($username) && !empty($password) && !empty($fName) && !empty($lName)) {
            // Hash the password for security (use appropriate hashing method, e.g., password_hash)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (user_name, email, firstName, lastName, password) VALUES ('$username', '$email', '$fName', '$lName', '$hashedPassword')";

            // Execute query
            if(mysqli_query($con, $query)) {
                echo "<script type='text/javascript'> alert('Successfully Registered'); </script>";
            } else {
                echo "<script type='text/javascript'> alert('Error: " . mysqli_error($con) . "'); </script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Please Enter Valid Information'); </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="sign.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form method="POST" class="form" id="createAccount">
            <h1 class="form__title">Create Account</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="user_name" autofocus placeholder="Username">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="email" autofocus placeholder="Email Address">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="firstName" autofocus placeholder="First Name">
                <div class="name"></div>
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="lastName" autofocus placeholder="Last Name">
                <div class="name"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="password" autofocus placeholder="Password">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" autofocus placeholder="Confirm Password">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit">Continue</button>
            <p class="form__text">
                <a class="form__link" href="login.php" id="linkLogIn">Already have an account? Sign In</a>
            </p>

            <p class="form__text">
                <a class="form__link" href="index.html" id="linkHome">BLAIREE Home</a>
            </p>
        </form>
    </div>
    <script src="sign.js"></script>
</body>
</html>
