<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create E-Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
<header class="header-container">
    <figure>
        <img src="img/logob.png" alt="Agency Logo">
    </figure>
    <p><strong>Birzeit Car Rental Agency</strong></p>

    <div class="links_header">
        <ul> 
        <li><a href="about_us_page.php">About Us</a></li>
            <li><a href="profile.php">User Profile</a></li>
            <li><a href="basket.php">Shopping Basket</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>

<main class="main_container">
<nav class="main-nav">
        <ul> 
        <li><a href="usersearch.php">Search car</a></li>
            <li><a href="viewRentedCar.php">View rented cars</a></li>
            <li><a href="user_return.php">Return a car</a></li>
        </ul>
    </nav>

    <form action="process_e_account.php" method="POST" class="main-content">
        <label for="username">Username (6-13 characters):</label>
        <input type="text" id="username" name="username" minlength="6" maxlength="13" required>

        <label for="password">Password (8-12 characters):</label>
        <input type="password" id="password" name="password" minlength="8" maxlength="12" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Next Step">
    </form>
</main>

<footer class="footer_container">
    <figure>
        <img src="img/logob.png" alt="BirzeitCarRentalAgency logo">
    </figure>
    <p><strong>Birzeit Car Rental Agency</strong></p>
    <address class="address_footer">
        <p>Contact us at:</p>
        <p><em>Email:</em> <a href="mailto:BirzeitCarRentalAgency@gmail.com"><em>BirzeitCarRentalAgency@gmail.com</em></a></p>
        <p><em>Telephone:</em> <a href="tel:0569699377"><em>0569699377</em></a></p>
    </address>
    <a href="contact.html"><em>Contact Us</em></a>
</footer> 
</body>
</html>


