
<?php
session_start();

$carid = isset($_SESSION['carid']) ? $_SESSION['carid'] : 'Not set';
$location = isset($_SESSION['pickup-location']) ? $_SESSION['pickup-location'] : 'Not set';
$startDate = isset($_SESSION['start-date']) ? $_SESSION['start-date'] : 'Not set';
$endDate = isset($_SESSION['end-date']) ? $_SESSION['end-date'] : 'Not set';
$numberOfDays = isset($_SESSION['number-of-days']) ? $_SESSION['number-of-days'] : 'Not set';
$totalPrice = isset($_SESSION['total-price']) ? $_SESSION['total-price'] : 'Not set';
$model = isset($_SESSION['model']) ? $_SESSION['model'] : 'Not set';
$description = isset($_SESSION['description']) ? $_SESSION['description'] : 'Not set';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
    <title>Print Session Variables in Form</title>
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
     
<form action="process_form_for_rent.php" method="post">
    <label for="carId">Car ID:</label>
    <input type="text" id="carId" name="carId" value="<?php echo $carid; ?>" readonly><br>

    <label for="location">Pickup Location:</label>
    <input type="text" id="location" name="location" value="<?php echo $location; ?>" readonly><br>

    <label for="startDate">Start Date:</label>
    <input type="text" id="startDate" name="startDate" value="<?php echo $startDate; ?>" readonly><br>

    <label for="endDate">End Date:</label>
    <input type="text" id="endDate" name="endDate" value="<?php echo $endDate; ?>" readonly><br>

    <label for="numberOfDays">Number of Days:</label>
    <input type="text" id="numberOfDays" name="numberOfDays" value="<?php echo $numberOfDays; ?>" readonly><br>

    <label for="totalPrice">Total Price:</label>
    <input type="text" id="totalPrice" name="totalPrice" value="<?php echo $totalPrice; ?>" readonly><br>

    <label for="model">Model:</label>
    <input type="text" id="model" name="model" value="<?php echo $model; ?>" readonly><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value="<?php echo $description; ?>" readonly><br>
    <h3>Special Requirements (additional cost)</h3>


<label for="babySeat">for each Baby Seat will be additional cost by 50  :</label>
<input type="number" id="babySeat" name="babySeat" value="babySeat" min="1" max="4"><br>


<label for="changelocation">if you change the return location will be additional cost by 100  :</label>
<select id="changelocation" name="changelocation">
    <option value="">Select a return location</option>
    <?php
    include_once "dbconfig.php";
    $sql = "SELECT name FROM location";
    $result = $pdo->query($sql);
    $locations = $result->fetchAll(PDO::FETCH_COLUMN); 
    foreach ($locations as $location) {
        echo '<option value="' . $location . '">' . $location . '</option>';
    }
    ?>
</select><br>

<label for="additionalDriver">if you want additional driver will be additional cost by 0:</label>
<input type="checkbox" id="additionalDriver" name="additionalDriver" ><br>

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

