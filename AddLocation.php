

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
            
            <li><a href="AddCar.php">Add car</a></li>
        </ul>
    </nav>

    <div class="main-content">
    <div>  <form action="" method="POST">
    <fieldset>
    <legend> <strong>Add Location</strong> </legend>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="enter pransh name required" >

        <label for="property_number">Property Number:</label>
        <input type="text" id="property_number" name="property_number" placeholder="enter the phone number for the pransh" required>

        <label for="street_name">Street Name:</label>
        <input type="text" id="street_name" name="street_name" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" placeholder="enter city name" required>

        <label for="postal_code">Postal Code:</label>
        <input type="text" id="postal_code" name="postal_code"  placeholder="enter Postal Code" required>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country"  placeholder="enter Country" required>

        <label for="telephone_number">Telephone Number:</label>
        <input type="text" id="telephone_number" name="telephone_number"  placeholder="Postal Code Telephone Number" required>

        <input type="submit" value="Add Location">
</fieldset>
    </form>
</div>
  


<?php
include 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = $_POST['name'];
        $propertyNumber = $_POST['property_number'];
        $streetName = $_POST['street_name'];
        $city = $_POST['city'];
        $postalCode = $_POST['postal_code'];
        $country = $_POST['country'];
        $telephoneNumber = $_POST['telephone_number'];

        $stmt = $pdo->prepare("INSERT INTO address (property_number, street_name, city, postal_code, country) 
                                VALUES (:propertyNumber, :streetName, :city, :postalCode, :country)");
        $stmt->bindValue(':propertyNumber', $propertyNumber);
        $stmt->bindValue(':streetName', $streetName);
        $stmt->bindValue(':city', $city);
        $stmt->bindValue(':postalCode', $postalCode);
        $stmt->bindValue(':country', $country);
        $stmt->execute();

        $addressId = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO location (name, address_id, telephone_number) 
                                VALUES (:name, :addressId, :telephoneNumber)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':addressId', $addressId);
        $stmt->bindValue(':telephoneNumber', $telephoneNumber);
        $stmt->execute();

        echo "location added";
    } catch (PDOException $e) {
        die("Error inserting data: " . $e->getMessage());
    }
}
?>
    </div>
</main>

  
</body>
</html>

<footer class="footer_container">
    <figure>
        <img src="img/logob.png" alt="BirzeitCarRentalAgency logo">
    </figure>
    <p><strong>Birzeit Car Rental Agency</strong></p>
   
</footer> 