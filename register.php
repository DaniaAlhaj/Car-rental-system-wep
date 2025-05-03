<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Search</title>
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

    <div class="main-content">
    <form action="process_registration.php" method="POST">
       
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="address">Address:</label>
        <input type="text" id="flat" name="flat" placeholder="Flat/House No." required>
        <input type="text" id="street" name="street" placeholder="Street" required>
        <input type="text" id="city" name="city" placeholder="City" required>
        <input type="text" id="country" name="country" placeholder="Country" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="id_number">ID Number:</label>
        <input type="text" id="id_number" pattern="\d{9}" name="id_number" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="telephone">Telephone:</label>
        <input type="text" id="telephone" name="telephone" required>

        <label for="card_number">Credit Card Number:</label>
        <input type="number" id="card_number" name="card_number" pattern="\d{9}" required>

        <label for="expiry_date">Expiration Date:</label>
        <input type="text" id="expiry_date" pattern="\d{2}/\d{2}" name="expiry_date" placeholder="MM/YY" required>

        <label for="card_name">Cardholder Name:</label>
        <input type="text" id="card_name" name="card_name" required>

        <label for="bank_name">Bank Name:</label>
        <input type="text" id="bank_name" name="bank_name" required>

        <input type="submit" value="Next Step">
    </form>
   </div>
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
