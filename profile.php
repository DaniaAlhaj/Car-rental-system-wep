<?php
session_start();
require_once "dbconfig.php";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $userid = $_SESSION['userid'];

    $query = "SELECT username, DateOfBirth, IdNumber, email, phone FROM user WHERE userid = :userid";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':userid', $userid);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $query2 = "SELECT flat, street, city, country FROM addresses WHERE userid = :userid";
    $stmt = $pdo->prepare($query2);
    $stmt->bindValue(':userid', $userid);
    $stmt->execute();
    $address = $stmt->fetch(PDO::FETCH_ASSOC);

    $query3 = "SELECT card_number, expiry_date, card_name, cardtype FROM credit_cards WHERE userid = :userid";
    $stmt = $pdo->prepare($query3);
    $stmt->bindValue(':userid', $userid);
    $stmt->execute();
    $credit_card = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
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
            <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="DateOfBirth">Date of Birth:</label>
                    <input type="date" id="DateOfBirth" name="DateOfBirth" value="<?php echo htmlspecialchars($user['DateOfBirth']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="IdNumber">ID Number:</label>
                    <input type="text" id="IdNumber" name="IdNumber" value="<?php echo htmlspecialchars($user['IdNumber']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                </div>
                <h3>Address Details</h3>
                <div class="form-group">
                    <label for="flat">Flat:</label>
                    <input type="text" id="flat" name="flat" value="<?php echo htmlspecialchars($address['flat']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" value="<?php echo htmlspecialchars($address['street']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($address['city']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($address['country']); ?>" required>
                </div>
                <h3>Credit Card Details</h3>
                <div class="form-group">
                    <label for="card_number">Card Number:</label>
                    <input type="text" id="card_number" name="card_number" value="<?php echo htmlspecialchars($credit_card['card_number']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="text" id="expiry_date" name="expiry_date" value="<?php echo htmlspecialchars($credit_card['expiry_date']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="card_name">Card Name:</label>
                    <input type="text" id="card_name" name="card_name" value="<?php echo htmlspecialchars($credit_card['card_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="cardtype">Card Type:</label>
                    <input type="text" id="cardtype" name="cardtype" value="<?php echo htmlspecialchars($credit_card['cardtype']); ?>" required>
                </div>
                <input type="submit" id="Update_Profile" name="Update_Profile" value="Update Profile">
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
    </body>
    </html>
    <?php
} else {
    echo "You must login first.";
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Update_Profile'])) {
        $updatedUsername = $_POST['username'];
        $updatedDateOfBirth = $_POST['DateOfBirth'];
        $updatedIdNumber = $_POST['IdNumber'];
        $updatedEmail = $_POST['email'];
        $updatedPhone = $_POST['phone'];
        $updatedFlat = $_POST['flat'];
        $updatedStreet = $_POST['street'];
        $updatedCity = $_POST['city'];
        $updatedCountry = $_POST['country'];
        $updatedCardNumber = $_POST['card_number'];
        $updatedExpiryDate = $_POST['expiry_date'];
        $updatedCardName = $_POST['card_name'];
        $updatedCardType = $_POST['cardtype'];

        $updateUserQuery = "UPDATE user SET username = :username, DateOfBirth = :DateOfBirth, IdNumber = :IdNumber, email = :email, phone = :phone WHERE userid = :userid";
        $stmt = $pdo->prepare($updateUserQuery);
        $stmt->bindValue(':username', $updatedUsername);
        $stmt->bindValue(':DateOfBirth', $updatedDateOfBirth);
        $stmt->bindValue(':IdNumber', $updatedIdNumber);
        $stmt->bindValue(':email', $updatedEmail);
        $stmt->bindValue(':phone', $updatedPhone);
        $stmt->bindValue(':userid', $userid);
        $stmt->execute();

        $updateAddressQuery = "UPDATE addresses SET flat = :flat, street = :street, city = :city, country = :country WHERE userid = :userid";
        $stmt = $pdo->prepare($updateAddressQuery);
        $stmt->bindValue(':flat', $updatedFlat);
        $stmt->bindValue(':street', $updatedStreet);
        $stmt->bindValue(':city', $updatedCity);
        $stmt->bindValue(':country', $updatedCountry);
        $stmt->bindValue(':userid', $userid);
        $stmt->execute();

        $updateCardQuery = "UPDATE credit_cards SET card_number = :card_number, expiry_date = :expiry_date, card_name = :card_name, cardtype = :cardtype WHERE userid = :userid";
        $stmt = $pdo->prepare($updateCardQuery);
        $stmt->bindValue(':card_number', $updatedCardNumber);
        $stmt->bindValue(':expiry_date', $updatedExpiryDate);
        $stmt->bindValue(':card_name', $updatedCardName);
        $stmt->bindValue(':cardtype', $updatedCardType);
        $stmt->bindValue(':userid', $userid);
        $stmt->execute();
    }
}
?>
