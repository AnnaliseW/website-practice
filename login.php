<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['user_name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE user_name = '$username' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['user_name'] = $user_data['user_name'];

                header("Location: home.php");
                die;
            } else {
                echo "<script type='text/javascript'> alert('Wrong Username or Password'); </script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Wrong Username or Password'); </script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('Please enter Username and Password'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="sign.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form method="POST" class="form" id="login">
            <h1 class="form__title">Login</h1>
            <div class="form__input-group">
                <input type="text" class="form__input" name="user_name" autofocus placeholder="Username">
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="password" autofocus placeholder="Password">
            </div>
            <button class="form__button" type="submit">Continue</button>
            <p class="form__text">
                <a href="#" class="form__link">Forgot your password?</a>
            </p>
            <p class="form__text">
                <a class="form__link" href="signup.php" id="linkCreateAccount">Don't have an account? Create Account</a>
            </p>

            <p class="form__text">
                <a class="form__link" href="index.html" id="linkHome"> BLAIREE Home</a>
            </p>
        </form>
    </div>
    <script src="form.js"></script>
</body>
</html>
