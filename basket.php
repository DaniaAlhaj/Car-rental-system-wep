<?php
session_start();


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {


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
        <h2>You have started to pick up the following car but you didn't complete the process. If you click to rent, you will go back to renting the car.</h2>
        <table>
            <thead>
                <tr special-text>
                   
                    <th>Fuel Type</th>
                    <th>Price Per Day</th>
                    <th>Car Details</th>
                </tr>
            </thead>
            <tbody>
<?php
include "dbconfig.php";

$userid = $_SESSION['userid'];

$query = "SELECT carid FROM basket WHERE userid = :userid";
$stmt = $pdo->prepare($query);
$stmt->execute(['userid' => $userid]);
$carIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

foreach ($carIds as $carid) {
    $query = "SELECT * FROM car WHERE carid = :carid";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['carid' => $carid]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($car) {
        echo '<tr>';
        echo '<td>' . ($car['fuel_type']) . '</td>';
        echo '<td>' . ($car['price_per_day']) . '</td>';
        echo '<td>
                <form action="details.php" method="GET">
                    <input type="hidden" name="carid" value="' . $car['carid'] . '">
                   
                    <input type="submit" value="Review car detail">
                </form>
              </td>';
              
        echo '</tr>';
    }
}
?>
            </tbody>
        </table>
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
<?php
}
else {
    header("Location: login.php");
    exit();
}
?>