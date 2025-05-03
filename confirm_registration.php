<?php
session_start();

$userid = mt_rand(100000000, 9999999999);
$_SESSION['userid']=$userid;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Registration</title>
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

    
    <form action="process_confirmation.php" method="POST"  class="main-content">
    
   
    <fieldset>
    <legend><strong>Confirmation Step</strong></legend>
    <label><strong>Customer ID:</strong></label>
    <input type="text" value="<?php echo $_SESSION['userid']; ?>" readonly>
    <br>
    <label><strong>Name:</strong></label>
    <input type="text" value="<?php echo $_SESSION['username']; ?>" readonly>
    <br>
    <label><strong>Address:</strong></label>
    <input type="text" value="<?php echo $_SESSION['flat'] . ', ' . $_SESSION['street'] . ', ' . $_SESSION['city'] . ', ' . $_SESSION['country']; ?>" readonly>
    <br>
    <label><strong>Date of Birth:</strong></label>
    <input type="text" value="<?php echo $_SESSION['dateofBirth']; ?>" readonly>
    <br>
    <label><strong>ID Number:</strong></label>
    <input type="text" value="<?php echo $_SESSION['idnumber']; ?>" readonly>
    <br>
    <label><strong>Email:</strong></label>
    <input type="text" value="<?php echo $_SESSION['email']; ?>" readonly>
    <br>
    <label><strong>Telephone:</strong></label>
    <input type="text" value="<?php echo $_SESSION['phone']; ?>" readonly>
    <br>
    <label><strong>Credit Card Number:</strong></label>
    <input type="text" value="<?php echo $_SESSION['card_number']; ?>" readonly>
    <br>
    <label><strong>Expiration Date:</strong></label>
    <input type="text" value="<?php echo $_SESSION['expiry_date']; ?>" readonly>
    <br>
    <label><strong>Cardholder Name:</strong></label>
    <input type="text" value="<?php echo $_SESSION['card_name']; ?>" readonly>
    <br>
    <label><strong>Bank Name:</strong></label>
    <input type="text" value="<?php echo $_SESSION['bank_name']; ?>" readonly>
    <br>
    <label><strong>Username:</strong></label>
    <input type="text" value="<?php echo $_SESSION['username']; ?>" readonly>
    <br>
        <input type="submit" value="Confirm">
        </fieldset>
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
