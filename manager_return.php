<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returned Cars - Manager View</title>
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
        <ul>    <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>

<main class="main_container">
    <nav class="main-nav">
        <ul> 
        <li><a href="managersearch.php">Search car</a></li>
            <li><a href="AddLocation.php">Add Location </a></li>
            <li><a href="manager_return.php">Return a car</a></li>
            
            <li><a href="AddCar.php">Add car</a></li>
        </ul>
    </nav>
    <div class="main-content">
        <?php
        include "dbconfig.php";

        $sql = "SELECT c.contractid, c.carid, c.pickuplocation, c.status, 
                       car.make AS carmake, car.type AS cartype, car.model AS carmodel, 
                       user.username AS username
                FROM contract c
                JOIN car ON c.carid = car.carid
                JOIN user ON c.userid = user.userid
                WHERE c.status = 'returning'
                ORDER BY c.contractid DESC";
        $stmt = $pdo->query($sql);

        echo '<table>';
        echo '<caption>List of Returning Cars</caption>';
        echo '<tr>';
        echo '<th>Car Reference Number</th>';
        echo '<th>Car Make</th>';
        echo '<th>Car Type</th>';
        echo '<th>Car Model</th>';
        echo '<th>Pickup Location</th>';
        echo '<th>Customer Name</th>';
        echo '<th>Status</th>';
        echo '<th>Action</th>';
        echo '</tr>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $carReferenceNumber = $row['contractid'];
            $carMake = $row['carmake'];
            $carType = $row['cartype'];
            $carModel = $row['carmodel'];
            $pickupLocation = $row['pickuplocation'];
            $customerName = $row['username'];
            $status = $row['status'];

            echo "<tr>";
            echo "<td>$carReferenceNumber</td>";
            echo "<td>$carMake</td>";
            echo "<td>$carType</td>";
            echo "<td>$carModel</td>";
            echo "<td>$pickupLocation</td>";
            echo "<td>$customerName</td>";
            echo "<td>$status</td>";
            echo "<td>
                    <form action='return_car.php' method='POST'>
                        <input type='hidden' name='carid' value='{$row['carid']}'>
                        <button type='submit'>Return</button>
                    </form>
                  </td>";
            echo '</tr>';
        }

        echo '</table>';
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
