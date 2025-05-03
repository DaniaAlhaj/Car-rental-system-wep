<?php
session_start();

include "dbconfig.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['carid'])) {
    $carid = $_POST['carid'];


    $sql = "SELECT carid, model, make, type, registration_year, description, 
                   price_per_day, capacity_people, capacity_suitcases, colors, 
                   fuel_type, avg_consumption, horsepower, length, width, conditions, 
                   plate_number, status
            FROM car
            WHERE carid = :carid";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['carid' => $carid]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>


<main class="main_container">
    <nav class="main-nav">
        <ul> 
      
            <li><a href="managersearch.php">Search car</a></li>
            <li><a href="AddLocation.php">Add Location </a></li>
            <li><a href="manager_return.php">Return a car</a></li>
        </ul>
    </nav>

    <div class="main-content">
    <h1>Edit Car</h1>
    <form method="POST" action="">
        <input type="hidden" name="carid" value="<?php echo $car['carid']; ?>">
        
        <label for="model">Model:</label>
        <input type="text" id="model" name="model"  value="<?php echo $car['model']; ?>" readonly><br>

        <label for="make">Make:</label>
        <input type="text" id="make" name="make" value="<?php echo $car['make']; ?>" readonly><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" value="<?php echo $car['type']; ?>" readonly><br>

        <label for="registration_year">Registration Year:</label>
        <input type="text" id="registration_year" name="registration_year" value="<?php echo $car['registration_year']; ?>" readonly><br>

        <label for="description">Description:</label>
        <textarea id="description" readonly name="description"><?php echo $car['description']; ?></textarea><br>

        <label for="price_per_day">Price per Day:</label>
        <input type="text" id="price_per_day" name="price_per_day" value="<?php echo $car['price_per_day']; ?>" readonly><br>

        <label for="capacity_people">Capacity (People):</label>
        <input type="text" id="capacity_people" name="capacity_people" value="<?php echo $car['capacity_people']; ?>" readonly><br>

        <label for="capacity_suitcases">Capacity (Suitcases):</label>
        <input type="text" id="capacity_suitcases" name="capacity_suitcases" value="<?php echo $car['capacity_suitcases']; ?>" readonly><br>

        <label for="colors">Colors:</label>
        <input type="text" id="colors" name="colors" value="<?php echo $car['colors']; ?>" readonly><br>

        <label for="fuel_type">Fuel Type:</label>
        <input type="text" id="fuel_type" name="fuel_type" value="<?php echo $car['fuel_type']; ?>" readonly><br>

        <label for="avg_consumption">Avg Consumption:</label>
        <input type="text" id="avg_consumption" name="avg_consumption" value="<?php echo $car['avg_consumption']; ?>" readonly><br>

        <label for="horsepower">Horsepower:</label>
        <input type="text" id="horsepower" name="horsepower" value="<?php echo $car['horsepower']; ?>" readonly><br>

        <label for="length">Length:</label>
        <input type="text" id="length" name="length" value="<?php echo $car['length']; ?>" readonly><br>

        <label for="width">Width:</label>
        <input type="text" id="width" name="width" value="<?php echo $car['width']; ?>" readonly><br>

        <label for="conditions">Conditions:</label>
        <input type="text" id="conditions" name="conditions" value="<?php echo $car['conditions']; ?>" readonly><br>

        <label for="plate_number">Plate Number:</label>
        <input type="text" id="plate_number" name="plate_number" value="<?php echo $car['plate_number']; ?>" readonly><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="available" <?php echo ($car['status'] == 'available' ? 'selected' : ''); ?>>Available</option>
            <option value="damaged" <?php echo ($car['status'] == 'damaged' ? 'selected' : ''); ?>>Damaged</option>
            <option value="repair" <?php echo ($car['status'] == 'repair' ? 'selected' : ''); ?>>Repair</option>
        </select><br>

        <input type="submit" value="Update Car">
    </form>
    </div>
</main>

  
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status']) ){
    $newStatus = $_POST['status']; 
    include "dbconfig.php";
 
        $updateSql = "UPDATE car SET status = :newStatus WHERE carid = :carid";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute(['newStatus' => $newStatus, 'carid' => $carid]);

        $message = "Status has been changed to $newStatus";
        echo $message ;
    

}


?>
<footer class="footer_container">
    <figure>
        <img src="img/logob.png" alt="BirzeitCarRentalAgency logo">
    </figure>
    <p><strong>Birzeit Car Rental Agency</strong></p>
   
</footer> 