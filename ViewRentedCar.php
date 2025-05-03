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
    <link rel="stylesheet" href="style2.css">
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
        <?php
        include "dbconfig.php";

        $currentDate = date('Y-m-d');
        $userid = $_SESSION['userid'];

        if (isset($_SESSION['userid'])) {
            $sql = "SELECT c.contractid, c.strartdate, c.enddate, c.carid, c.total_price, c.extra_cost, c.invoicedate, 
                           c.pickuplocation, c.returnlocation, car.type AS cartype, car.model AS carmodel 
                    FROM contract c
                    JOIN car ON c.carid = car.carid
                    WHERE c.userid = :userid 
                    ORDER BY c.strartdate DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['userid' => $userid]);

            echo '<table>';
            echo '<caption>List of rented cars you have</caption>';
            echo '<tr>';
            echo '<th>Contract ID</th>';
            echo '<th>Car Type</th>';
            echo '<th>Car Model</th>';
            echo '<th>Car ID</th>';
            echo '<th>Invoice Date</th>';
            echo '<th>Pick-up Location</th>';
            echo '<th>Return Location</th>';
            echo '<th>Status</th>';
            echo '</tr>';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contractID = $row['contractid'];
                $carType = $row['cartype'];
                $carModel = $row['carmodel'];
                $carID = $row['carid'];
                $invoiceDate = $row['invoicedate'];
                $pickupLocation = $row['pickuplocation'];
                $returnLocation = $row['returnlocation'];

                $rentalStatus = '';
                if ($row['strartdate'] > $currentDate) {
                    $rentalStatus = 'future';
                } elseif ($row['enddate'] < $currentDate) {
                    $rentalStatus = 'past';
                } else {
                    $rentalStatus = 'current';
                }

                echo "<tr class='$rentalStatus'>";
                echo "<td>$contractID</td>";
                echo "<td>$carType</td>";
                echo "<td>$carModel</td>";
                echo "<td>$carID</td>";
                echo "<td>$invoiceDate</td>";
                echo "<td>$pickupLocation</td>";
                echo "<td>$returnLocation</td>";
                echo "<td>$rentalStatus</td>";
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "User ID not set in session.";
        }
        ?>
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