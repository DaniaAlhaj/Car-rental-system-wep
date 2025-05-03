
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $babySeatcost = isset($_POST['babySeat']) ? intval($_POST['babySeat']) * 50 : 0;


if( isset($_POST['changelocation'])) {
    if ($_POST['changelocation']=="Select a return location"){
        $changelocationcost=0;
    }
    else {
        $changelocationcost=100;
    }
}

    $additionalDriverrcost = isset($_POST['additionalDriver']) ? 300 : 0;

    $returnlocation=isset($_POST['changelocation']) ? $_POST['changelocation'] : $_SESSION['pickup-location'];



$dania=isset($_POST['changelocation']) ? $_POST['changelocation'] : '';

$_SESSION['dania'] = $dania;


    $_SESSION['additionalDrivercost'] = $additionalDriverrcost;
    $_SESSION['babySeatcost'] = $babySeatcost;
    $_SESSION['changelocationcost'] = $changelocationcost;

    $_SESSION['changelocationcost_return'] = $_POST['changelocation'];

    $location = $_SESSION['pickup-location'];
   
    $changelocation = isset($_POST['changelocation']) ? $_POST['changelocation'] : $location;
   
    $totalPrice = isset($_SESSION['total-price']) ? $_SESSION['total-price'] : 0;
    $totalAmount = $totalPrice; 

    if ($babySeatcost > 0 && $changelocationcost == 0 && $additionalDriverrcost == 0) {
        $totalAmount += $babySeatcost;
        $additional_cost_details = "You added a baby seat for each 50, so the total cost for it is: " . $babySeatcost;
    } 
    
    elseif ($babySeatcost == 0 && $changelocationcost > 0 && $additionalDriverrcost == 0) {
        $totalAmount += $changelocationcost;
        $additional_cost_details = "You changed the location to: " . $changelocation . " costing 100";
    }
    
    elseif ($babySeatcost == 0 && $changelocationcost == 0 && $additionalDriverrcost > 0) {
        $totalAmount += $additionalDriverrcost;
        $additional_cost_details = "You added an additional driver costing 300";
    } 
    
    elseif ($babySeatcost > 0 && $changelocationcost > 0 && $additionalDriverrcost > 0) {
        $totalAmount += $babySeatcost + $changelocationcost + $additionalDriverrcost;
        $additional_cost_details = "You added an additional driver costing 300, changed the location to: " . $changelocation . " costing 100, and added a baby seat for each 50 so the total cost for it is: " . $babySeatcost;
    }
    
    elseif ($babySeatcost > 0 && $changelocationcost > 0 && $additionalDriverrcost == 0) {
        $totalAmount += $babySeatcost + $changelocationcost;
        $additional_cost_details = "You changed the location to: " . $changelocation . " costing 100, and added a baby seat for each 50 so the total cost for it is: " . $babySeatcost;
    } 
    
    elseif ($babySeatcost > 0 && $changelocationcost == 0 && $additionalDriverrcost > 0) {
        $totalAmount += $babySeatcost + $additionalDriverrcost;
        $additional_cost_details = "You added an additional driver costing 300, and added a baby seat for each 50 so the total cost for it is: " . $babySeatcost;
    } 
    
    elseif ($babySeatcost == 0 && $changelocationcost > 0 && $additionalDriverrcost > 0) {
        $totalAmount += $changelocationcost + $additionalDriverrcost;
        $additional_cost_details = "You added an additional driver costing 300, and changed the location to: " . $changelocation . " costing 100";
    }
    elseif ($babySeatcost == 0 && $changelocationcost == 0 && $additionalDriverrcost  ==0) {
        $totalAmount += 0;
        $additional_cost_details = "no additional cost " ;
    }

    $_SESSION['totalAmount'] = $totalAmount;

    $_SESSION['additional_cost_details'] = $additional_cost_details;

    $flat = isset($_SESSION['flat']) ? $_SESSION['flat'] : '';
    $street = isset($_SESSION['street']) ? $_SESSION['street'] : '';
    $city = isset($_SESSION['city']) ? $_SESSION['city'] : '';
    $country = isset($_SESSION['country']) ? $_SESSION['country'] : '';

    $carId = isset($_SESSION['carid']) ? $_SESSION['carid'] : '';
    $location = isset($_SESSION['pickup-location']) ? $_SESSION['pickup-location'] : '';
    $startDate = isset($_SESSION['start-date']) ? $_SESSION['start-date'] : '';
    $endDate = isset($_SESSION['end-date']) ? $_SESSION['end-date'] : '';
    $numberOfDays = isset($_SESSION['number-of-days']) ? $_SESSION['number-of-days'] : 0;
    $model = isset($_SESSION['model']) ? $_SESSION['model'] : '';
    $description = isset($_SESSION['description']) ? $_SESSION['description'] : '';

    $card_number = isset($_SESSION['card_number']) ? $_SESSION['card_number'] : '';
   
   
    include_once "dbconfig.php";

    $userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';

    if ($userid) {
        $sql = "SELECT username, phone FROM user WHERE userid = :userid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userid' => $userid]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $sql = "SELECT * FROM credit_cards WHERE userid = :userid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['userid' => $userid]);
            $cardinfo = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($cardinfo) {
                $card_numbers = $cardinfo['card_number'];
                $expiry_dates = $cardinfo['expiry_date'];
                $card_names = $cardinfo['card_name'];
                $bank_names = $cardinfo['bank_name'];
            }

            $sql = "SELECT * FROM addresses WHERE userid = :userid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['userid' => $userid]);
            $addressInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($addressInfo) {
                $flat = $addressInfo['flat'];
                $street = $addressInfo['street'];
                $city = $addressInfo['city'];
                $country = $addressInfo['country'];
            }
        } else {
            echo "No user found with the given ID.";
        }
    } else {
        echo "User ID is not set in the session.";
    }

    $invoicedate = date('Y-m-d');
}
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
        <ul>    <li><a href="usersearch.php">Search car</a></li>
            <li><a href="viewRentedCar.php">View rented cars</a></li>
            <li><a href="user_return.php">Return a car</a></li>
        </ul>
    </nav>

    <div class="main-content">
     
<div class="invoice">
    <h2>Rent Invoice</h2>
    
    <form action="confirm_rent.php" method="post">
        <label for="invoiceDate">Invoice Date:</label>
        <input type="text" id="invoiceDate" name="invoiceDate" value="<?php echo $invoicedate ?>" readonly>
        
        <label for="customerId">Customer ID:</label>
        <input type="text" id="customerId" name="customerId" value="<?php echo $userid ?>" readonly>

        <label for="customerName">Customer Name:</label>
        <input type="text" id="customerName" name="customerName" value="<?php echo $user['username']; ?>" readonly>
   
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $flat . " " . $street . " " . $city . " " . $country; ?>" readonly>
   
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" readonly>
   
        <h3>Rent Details</h3>
      
        <label for="carId">Car ID:</label>
        <input type="text" id="carId" name="carId" value="<?php echo $carId; ?>" readonly>
        
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" value="<?php echo $model; ?>" readonly>
       
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $description; ?>" readonly>
        
        <label for="pickupLocation">Pickup Location:</label>
        <input type="text" id="pickupLocation" name="pickupLocation" value="<?php echo $location; ?>" readonly>
       
        <label for="startDate">Start Date:</label>
        <input type="text" id="startDate" name="startDate" value="<?php echo $startDate; ?>" readonly>
       
        <label for="endDate">End Date:</label>
        <input type="text" id="endDate" name="endDate" value="<?php echo $endDate; ?>" readonly>
       
        <label for="numberOfDays">Number of Days:</label>
        <input type="text" id="numberOfDays" name="numberOfDays" value="<?php echo $numberOfDays; ?>" readonly>
       
        <label for="totalPrice">Total Price:</label>
        <input type="text" id="totalPrice" name="totalPrice" value="<?php echo $totalPrice; ?>" readonly>
      
        <h3>Additional Requirements</h3>
        
        <label for="additionalDriverCost">Additional Driver Cost:</label>
        <input type="text" id="additionalDriverCost" name="additionalDriverCost" value="<?php echo $additionalDriverrcost; ?>" readonly>
        
        <label for="babySeatCost">Baby Seat Cost:</label>
        <input type="text" id="babySeatCost" name="babySeatCost" value="<?php echo $babySeatcost; ?>" readonly>
       
        <label for="changeLocationCost">Change Location Cost:</label>
        <input type="text" id="changeLocationCost" name="changeLocationCost" value="<?php echo $changelocationcost; ?>" readonly>
        
        <label for="changeLocation">New Return Location:</label>
        <input type="text" id="changeLocation" name="changeLocation" value="<?php echo  $changelocation ; ?>" readonly>
       
       
        <label for="cardNumber">Card Number (9 digits):</label>
        <input type="text" id="cardNumber" name="cardNumber" pattern="\d{9}" value="<?php echo $card_numbers; ?>" required><br>

        <label for="expiryDate">Expiry Date (MM/YY):</label>
        <input type="text" id="expiryDate" name="expiryDate" pattern="\d{2}/\d{2}" value="<?php echo $expiry_dates; ?>" required><br>

        <label for="cardName">Card Holder Name:</label>
        <input type="text" id="cardName" name="cardName" value="<?php echo $card_names; ?>" required><br>

        <label for="bankName">Bank Name:</label>
        <input type="text" id="bankName" name="bankName" value="<?php echo $bank_names; ?>" required><br>

        <label>Card Type:</label>
        <input type="radio" id="visa"  name="cardType" value="Visa" required>
        <label for="visa">Visa</label>
        <input type="radio" id="masterCard" name="cardType" value="Master Card" required>
        <label for="masterCard">Master Card</label>
        <input type="radio" id="pal_pay" name="cardType" value="pal pay" required>
        <label for="pal_pay">pal pay</label><br>

        <input type="submit" value="Confirm Rent">
    </form>
</div>

     
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

