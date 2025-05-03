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
        <ul>   <li><a href="usersearch.php">Search car</a></li>
            <li><a href="viewRentedCar.php">View rented cars</a></li>
            <li><a href="user_return.php">Return a car</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <?php if (isset($_GET['page'])) {
                $page = $_GET['page'];

                if ($page == 'rent') {
                    include('rent.php');
                } elseif ($page == 'search') {
                    include('usersearch.php');
                } elseif ($page == 'view_rented') {
                    include('view_rented.php');
                } elseif ($page == 'return') {
                    include('return.php');
                } 
            } else {
                include "dbconfig.php";
                include 'CarClass.php';

                if (isset($_GET['carid'])) {
                    $carId = $_GET['carid'];
                
                    $sql = "SELECT carid, model, make, type, registration_year, description, price_per_day, 
                    capacity_people, capacity_suitcases, colors, fuel_type, avg_consumption, horsepower,
                    length, width, conditions, plate_number FROM car WHERE carid = ?";
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$carId]);
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($result) {
                        $carObject = new Car(
                            $result['carid'],
                            $result['model'],
                            $result['make'],
                            $result['type'],
                            $result['registration_year'],
                            $result['description'],
                            $result['price_per_day'],
                            $result['capacity_people'],
                            $result['capacity_suitcases'],
                            $result['colors'],
                            $result['fuel_type'],
                            $result['avg_consumption'],
                            $result['horsepower'],
                            $result['length'],
                            $result['width'],
                            $result['plate_number'],
                            $result['conditions'],
                            $pdo 
                        );
                        echo "<div class='car_details'>";
                        echo "<div class='photo_details'>";
                        echo '<figure class="img_details">' ; 
                       echo '<img src="' . $carObject->getPhoto() . '" alt="Car Photo" >';
                       echo '</figure>' ; 
                        echo "</div>";

                        echo "<div class='info_details'>";
                        echo "<h2>Car Details</h2>";
                        echo "<ul>";
                        
                        echo "<li>car referance number : " . $result['carid'] . "</li>";
                        echo "<li>Model: " . $result['model'] . "</li>";
                        echo "<li>Make: " . $result['make'] . "</li>";
                        echo "<li>Type: " .  $result['type'] . "</li>";
                        echo "<li>Registration Year: " . $result['registration_year'] . "</li>";
                        echo "<li>Description: " .  $result['description'] . "</li>";
                        echo "<li>Price per Day: $" .$result['price_per_day'] . "</li>";
                        echo "<li>Capacity (People): " . $result['capacity_people'] . "</li>";
                        echo "<li>Capacity (Suitcases): " . $result['capacity_suitcases'] . "</li>";
                        echo "<li>Colors: " . $result['colors'] . "</li>";
                        echo "<li>Fuel Type: " . $result['fuel_type'] . "</li>";
                        echo "<li>Average Consumption: " . $result['avg_consumption'] . " L/100km</li>";
                        echo "<li>Horsepower: " . $result['horsepower'] . " HP</li>";
                        echo "<li>Length: " . $result['length'] . " m</li>";
                        echo "<li>Width: " . $result['width']  . " m</li>";
                        echo "<li>Conditions: " . $result['conditions']  . "</li>";
                        echo "<li>Plate Number: " . $result['plate_number'] . "</li>";
                        echo '<li>
                                <form action="check_if_login.php" method="POST">
                                    <input type="hidden" name="carid" value="' . $result['carid'] . '">
                                    <input type="submit" value="Rent">
                                </form>
                              </li>';
                        echo "</ul>";
                        echo "</div>";
                        
                        echo "</div>";
                    } else {
                        echo "<p>Car details not found.</p>";
                    }
                } else {
                    echo "<p>No car selected.</p>";
                }
            }
        ?>
    </div>
    <div class="markiting">
<p>Discover the ultimate driving experience with the all-new Designed to perfection,
     this car combines cutting-edge technology with unparalleled comfort and style.
      With its sleek exterior, spacious interior, and advanced safety features, 
       is perfect for both city driving and long road trips.</p>
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
