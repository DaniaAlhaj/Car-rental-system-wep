<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['username'];
    $password =$_POST['password'];
    $confirm_password =$_POST['confirm_password'];

    if ($password === $confirm_password) {
        $_SESSION['username'] = $username;
        $_SESSION['user_password'] = md5($password);

        header("Location: confirm_registration.php");
        exit;
    } else {
        echo "Passwords do not match.";
    }
} 
?>
