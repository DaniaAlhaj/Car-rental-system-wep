
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    
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
    <form action="search_results.php" method="post">
    <label > the available cars for a certain period:</label>
</br>
    <label for="from_date"> from date :</label>
    <input type="date" id="from_date" name="from_date">
    <label for="to_date">To Date:</label>
    <input type="date" id="to_date" name="to_date">


    <label for="return_date"> all cars that will be returned on a certain day:</label>
    <input type="date" id="return_date" name="return_date">

    <label for="return_location">return to a certain location :</label>
    <input type="text" id="return_location" name="return_location">

    <input type="checkbox" id="repair_status" name ="repair_status">
    <label for="repair_status">All car in  Repair:</label>

    </br>
    <input type="checkbox" id="damage_status" name ="damage_status">
    <label for="damage_status">All car in damged:</label>

    </br>
    <input type="submit" value="Search">
</form>

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
