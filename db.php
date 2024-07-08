<?php
$con = mysqli_connect("localhost", "root", "", "login_sample_db");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
