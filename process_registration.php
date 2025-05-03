<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $_SESSION['username'] = $_POST['name'];
    $_SESSION['flat'] =$_POST['flat'];
    $_SESSION['street'] =$_POST['street'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['dateofBirth'] = $_POST['dob'];
    $_SESSION['idnumber'] = $_POST['id_number'];
    $_SESSION['email'] =$_POST['email'];
    $_SESSION['phone'] = $_POST['telephone'];
    $_SESSION['card_number'] =$_POST['card_number'];
    $_SESSION['expiry_date'] = $_POST['expiry_date'];
    $_SESSION['card_name'] =$_POST['card_name'];
    $_SESSION['bank_name'] = $_POST['bank_name'];

    header("Location: create_e_account.php");
    exit;
} 
?>