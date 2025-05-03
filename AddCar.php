
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
 
<form action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend> <strong>Add a car</strong> </legend>
        <label for="plate-number">Plate Number:</label>
        <input type="text" id="plate-number" name="plate_number" required>
        

        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required>
        
        
        <label for="car-make">Car Make:</label>
        <select id="car-make" name="car_make">
            <option value="BMW">BMW</option>
            <option value="VW">VW</option>
            <option value="Volvo">Volvo</option>
            <option value="Toyota">Toyota</option>
            <option value="Honda">Honda</option>
            <option value="Mazda">Mazda</option>
            <option value="Hyundai">Hyundai</option>
            <option value="Kia">Kia</option>
        </select>
       

        <label for="car-type">Car Type:</label>
        <select id="car-type" name="car_type">
            <option value="Sedan">Sedan</option>
            <option value="SUV">SUV</option>
            <option value="Hatchback">Hatchback</option>
            <option value="Coupe">Coupe</option>
            <option value="Convertible">Convertible</option>
            <option value="Wagon">Wagon</option>
            <option value="Minivan">Minivan</option>
        </select>
        

        <label for="registrationyear">Registration Year:</label>
        <input type="text" id="registrationyear" name="registration_year" required>
       

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        

        <label for="price-per-day">Price per Day:</label>
        <input type="text" step="0.01" id="price-per-day" name="price_per_day" required>
       

        <label for="capacity-people">Capacity (People):</label>
        <input type="text" id="capacity-people" name="capacity_people" required>
       

        <label for="capacity-suitcases">Capacity (Suitcases):</label>
        <input type="text" id="capacity-suitcases" name="capacity_suitcases" required>
      

        <label for="colors">Colors:</label>
        <input type="text" id="colors" name="colors" required>
    

        <label for="fuel-type">Fuel Type:</label>
        <select id="fuel-type" name="fuel_type">
            <option value="Petrol">Petrol</option>
            <option value="Diesel">Diesel</option>
            <option value="Electric">Electric</option>
            <option value="Hybrid">Hybrid</option>
        </select>
     

        <label for="avg-consumption">Average Consumption (L/100km):</label>
        <input type="text" step="0.01" id="avg-consumption" name="avg_consumption" required>
        

        <label for="horsepower">Horsepower:</label>
        <input type="text" id="horsepower" name="horsepower" required>
        

        <label for="length">Length (m):</label>
        <input type="text" id="length" name="length" required>
        

        <label for="width">Width (m):</label>
        <input type="text" id="width" name="width" required>
        

        <label for="conditions">Conditions or Restrictions:</label>
        <textarea id="conditions" name="conditions"></textarea>
      

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" required><br>
       
        <input type="submit" name="Add" value="Add">
    </fieldset>
</form>


<?php
require_once 'dbconfig.php';

function generateUniqueCarId($pdo, $length = 10) {
    while (true){

        $number = '';
        for ($i = 0; $i < $length; $i++) {
            $digit = $i === 0 ? random_int(1, 9) : random_int(0, 9);
            $number .= $digit;
        }

        
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM car WHERE carid = :number");
        $stmt->bindParam(':number', $number); 
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count==0){
            return $number;
            break;
        }
      
        
    }
   
}


if (isset($_POST['Add'])) {
    try {
        $pdo->beginTransaction();

        $carid = generateUniqueCarId($pdo);
   

        $sql_car = "INSERT INTO car (carid, plate_number, model, make, type, registration_year, description, price_per_day, capacity_people, 
        capacity_suitcases, colors, fuel_type, avg_consumption, horsepower, length, width, conditions, status)
        VALUES (:carid, :plate_number, :model, :make, :type, :registration_year, :description, :price_per_day, :capacity_people, 
        :capacity_suitcases, :colors, :fuel_type, :avg_consumption, :horsepower, :length, :width, :conditions , :status)";
        
        $stmt_car = $pdo->prepare($sql_car);
        
        $stmt_car->bindValue(':carid', $carid);
        $stmt_car->bindValue(':plate_number', $_POST['plate_number']);
        $stmt_car->bindValue(':model', $_POST['model']);
        $stmt_car->bindValue(':make', $_POST['car_make']);
        $stmt_car->bindValue(':type', $_POST['car_type']);
        $stmt_car->bindValue(':registration_year', $_POST['registration_year']);
        $stmt_car->bindValue(':description', $_POST['description']);
        $stmt_car->bindValue(':price_per_day', $_POST['price_per_day']);
        $stmt_car->bindValue(':capacity_people', $_POST['capacity_people']);
        $stmt_car->bindValue(':capacity_suitcases', $_POST['capacity_suitcases']);
        $stmt_car->bindValue(':colors', $_POST['colors']);
        $stmt_car->bindValue(':fuel_type', $_POST['fuel_type']);
        $stmt_car->bindValue(':avg_consumption', $_POST['avg_consumption']);
        $stmt_car->bindValue(':horsepower', $_POST['horsepower']);
        $stmt_car->bindValue(':length', $_POST['length']);
        $stmt_car->bindValue(':width', $_POST['width']);
        $stmt_car->bindValue(':conditions', $_POST['conditions']);

        $stmt_car->bindValue(':status', 'available');
        $stmt_car->execute();

        if (!empty($_FILES['image']['name'])) {
            $fileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($fileType, ['jpeg', 'jpg', 'png'])) {
                $photoName = "car" . $carid . "img1.$fileType";
                $path = "images/" . $photoName;
                move_uploaded_file($_FILES['image']['tmp_name'], $path);

                $sql_img = "INSERT INTO car_images (imgname, carid) VALUES (:imgname, :carid)";
                $stmt_img = $pdo->prepare($sql_img);
                $stmt_img->bindParam(":imgname", $photoName);
                $stmt_img->bindParam(":carid", $carid);
                $stmt_img->execute();
            } else {
                throw new Exception("Invalid file type. Only jpeg, jpg, and png are allowed.");
            }
        } else {
            throw new Exception("You must upload an image.");
        }

        $pdo->commit();
        echo "New car inserted successfully with ID: $carid";

    } catch (Exception $e) {
        $pdo->rollBack();
        die("Exception: " . $e->getMessage());
    } catch (PDOException $e) {
        $pdo->rollBack();
        die("PDO Exception: " . $e->getMessage());
    }
}


?>

    </div>
</main>


<footer class="footer_container">
    <figure>
        <img src="img/logob.png" alt="BirzeitCarRentalAgency logo">
    </figure>
    <p><strong>Birzeit Car Rental Agency</strong></p>
   
</footer> 
</body>
</html>

