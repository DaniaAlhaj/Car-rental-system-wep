
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
      
<div class="search">
    <h2>Search for a Car Rental</h2>
    <form action="" method="POST">
        <label for="start-date">Renting From:</label>
        <input type="date" id="start-date" name="start-date" required>
        
        <label for="end-date">Renting To:</label>
        <input type="date" id="end-date" name="end-date" required>
        
        <label for="car-type">Car Type:</label>
        <select id="car-type" name="car-type">
            <option value="">select car type</option>
            <option value="sedan">Sedan</option>
            <option value="suv">SUV</option>
            <option value="hatchback">Hatchback</option>
            <option value="convertible">Convertible</option>
            <option value="pickup">Pickup</option>
            <option value="minivan">Minivan</option>
        </select>
        
        <label for="pickup-location">Pick-Up Location:</label>
        <input type="text" id="pickup-location" name="pickup-location" placeholder="Enter location">
        
        <label for="price-min">Min Price (per day):</label>
        <input type="number" id="price-min" name="price-min" placeholder="Min Price" min="150">
        
        <label for="price-max">Max Price (per day):</label>
        <input type="number" id="price-max" name="price-max" placeholder="Max Price" min="150">
    
        <input type="submit" name="usearch" id="usearch" value="Search">
    </form>
</div>

<?php
require_once "dbconfig.php";
include 'CarClass.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['pickup-location'];
    $carType = $_POST['car-type'];
    $minPrice = $_POST['price-min'];
    $maxPrice = $_POST['price-max'];
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];

   
    try {
        $checkLocation = $pdo->prepare("SELECT COUNT(*) FROM location WHERE name = :location");
        $checkLocation->bindValue(':location', $location);
        $checkLocation->execute();
        $locationExists = $checkLocation->fetchColumn();

        if ($locationExists) {
            $formattedStartDate = (new DateTime($startDate))->format('Y-m-d');
            $formattedEndDate = (new DateTime($endDate))->format('Y-m-d');

            $checkReservations = $pdo->prepare("SELECT carid FROM contract WHERE strartdate <= :end_date AND enddate >= :start_date");
            $checkReservations->bindValue(':start_date', $formattedStartDate);
            $checkReservations->bindValue(':end_date', $formattedEndDate);
            $checkReservations->execute();
            $reservedCarIds = $checkReservations->fetchAll(PDO::FETCH_COLUMN);

            $query = "SELECT * FROM car WHERE type = :type AND price_per_day BETWEEN :min_price AND :max_price";
            if (!empty($reservedCarIds)) {
                $query .= " AND carid NOT IN (" . implode(',', $reservedCarIds) . ")";
            }
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':type', $carType);
            $stmt->bindValue(':min_price', $minPrice);
            $stmt->bindValue(':max_price', $maxPrice);
            $stmt->execute();
            $availableCars = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($availableCars)) {
                echo '<table id="carTable">';
                echo '<thead>';
                echo '<tr>';
                echo '<th><button id="shortlistButton">Shortlist</button></th>';
                echo '<th>Price Per Day</th>';
                echo '<th>Car Type</th>';
                echo '<th>Fuel Type</th>';
                echo '<th>Car Photo</th>';
                echo '<th>Action</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($availableCars as $car) {
                    $carObject = new Car(
                        $car['carid'],
                        $car['model'],
                        $car['make'],
                        $car['type'],
                        $car['registration_year'],
                        $car['description'],
                        $car['price_per_day'],
                        $car['capacity_people'],
                        $car['capacity_suitcases'],
                        $car['colors'],
                        $car['fuel_type'],
                        $car['avg_consumption'],
                        $car['horsepower'],
                        $car['length'],
                        $car['width'],
                        $car['plate_number'],
                        $car['conditions'],
                        $pdo 
                    );
                    echo '<tr>';
                    
            echo '<td><input type="checkbox" class="shortlistCheckbox"></td>';
                    echo '<td>' . $carObject->getPricePerDay() . '</td>';
                    echo '<td>' . $carObject->getType() . '</td>';
                    echo '<td class="' . $carObject->getFuelType() . '">' . $carObject->getFuelType() . '</td>';
                    echo '<td><img src="' . $carObject->getPhoto() . '" alt="Car Photo" style="width: 200px; height: 150px;"></td>';
                    echo '<td>
                   <form action="save_session_for_search.php" method="POST">
            <input type="hidden" name="carid" value="' . $car['carid'] . '">
            <input type="hidden" name="pickup-location" value="' . $location . '">
            <input type="hidden" name="start-date" value="' . $startDate . '">
            <input type="hidden" name="end-date" value="' . $endDate . '">
            <input type="submit" value="Review car detail">
        </form>
                  </td>';
                    echo '</tr>';
                }
                

                echo '</tbody>';
                echo '</table>';


            } else {
                echo 'No cars available matching your criteria.';
                
            }
        } else {
            echo "We don't have a branch in $location.";

               }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        
    $date1 = new DateTime(); 
    $date2 = clone $date1;
    $date2->modify('+1 day');
    $date3 = clone $date2; 
    $date3->modify('+1 day'); 


    $formattedDate1 = $date1->format('Y-m-d');
    $formattedDate2 = $date2->format('Y-m-d');
    $formattedDate3 = $date3->format('Y-m-d');

    $check3day1 = $pdo->prepare("SELECT carid FROM contract WHERE strartdate <= :first AND enddate >= :first");
    $check3day2 = $pdo->prepare("SELECT carid FROM contract WHERE strartdate <= :second AND enddate >= :second");
    $check3day3 = $pdo->prepare("SELECT carid FROM contract WHERE strartdate <= :third AND enddate >= :third");
    	
    $check3day1->bindValue(':first', $date1->format('Y-m-d'));
    $check3day2->bindValue(':second', $date2->format('Y-m-d'));
    $check3day3->bindValue(':third', $date3->format('Y-m-d'));

    $check3day1->execute();
    $check3day2->execute();
    $check3day3->execute();

    $reservedCars1 = $check3day1->fetchAll(PDO::FETCH_COLUMN);
    $reservedCars2 = $check3day2->fetchAll(PDO::FETCH_COLUMN);
    $reservedCars3 = $check3day3->fetchAll(PDO::FETCH_COLUMN);

    $reservedCars = array_unique(array_merge($reservedCars1, $reservedCars2, $reservedCars3));

    $stmt = $pdo->prepare("SELECT * FROM car WHERE type = :type AND price_per_day BETWEEN :min_price AND :max_price");
    $stmt->bindValue(':type', 'Sedan');
    $stmt->bindValue(':min_price', 200);
    $stmt->bindValue(':max_price', 1000);
    $stmt->execute();

    $cars = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (!in_array($row['carid'], $reservedCars)) {
            $car = new Car(
                $row['carid'],
                $row['model'],
                $row['make'],
                $row['type'],
                $row['registration_year'],
                $row['description'],
                $row['price_per_day'],
                $row['capacity_people'],
                $row['capacity_suitcases'],
                $row['colors'],
                $row['fuel_type'],
                $row['avg_consumption'],
                $row['horsepower'],
                $row['length'],
                $row['width'],
                $row['plate_number'],
                $row['conditions'],
                $pdo 
            );
            $cars[] = $car;
        }
    }
?>

<table id="carTable">
    <thead>
        <tr>
            <th>
                
            <form action="display.php" method="POST">
            
                <input type="submit" value="shortlist">
            </form>
            </th>
            <th>Price Per Day</th>
            <th>Car Type</th>
            <th>Fuel Type</th>
            <th>Car Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($cars as $car) {
            echo '<tr>';
            echo '<td><input type="checkbox" class="shortlistCheckbox"></td>';
            echo '<td>' . $car->getPricePerDay() . '</td>';
            echo '<td>' . $car->getType() . '</td>';
            echo '<td class="' . strtolower($car->getFuelType()) . '">' . $car->getFuelType() . '</td>';
            echo '<td><img src="' . $car->getPhoto() . '" alt="Car Photo" style="width: 200px; height: 150px;"></td>';

            echo '<td>
            
            <form action="save_session_for_search.php" method="POST">
               <input type="hidden" name="carid" value="' . $car->getCarId() . '">
            <input type="hidden" name="pickup-location" value="' . 'Birzeit'. '">
            <input type="hidden" name="start-date" value="' . $formattedDate1 . '">
            <input type="hidden" name="end-date" value="' . $formattedDate3 . '">
                <input type="submit" value="Review car detail">
            </form>
          </td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<?php
}}
 catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


    
 catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
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
