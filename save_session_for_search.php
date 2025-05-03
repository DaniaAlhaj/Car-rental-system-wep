<?php
session_start();
require_once "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carId = $_POST['carid'];
    $location = $_POST['pickup-location'];
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];

    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = $start->diff($end);
    $numberOfDays = $interval->days;

    $stmt = $pdo->prepare("SELECT price_per_day , model ,description   FROM car WHERE carid = :carid");
    $stmt->bindValue(':carid', $carId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {

        $pricePerDay = $row['price_per_day'];

        $totalPrice = $pricePerDay * $numberOfDays;

        $_SESSION['carid'] = $carId;
        $_SESSION['pickup-location'] = $location;
        $_SESSION['start-date'] = $startDate;
        $_SESSION['end-date'] = $endDate;
        $_SESSION['number-of-days'] = $numberOfDays;
        $_SESSION['total-price'] = $totalPrice;
        $_SESSION['model'] = $row['model'];
        $_SESSION['description'] = $row['description'];


        header("Location: details.php?carid=" . $carId);
        exit();
    } else {
        echo "Car not found.";
    }
} else {
    echo "Invalid request.";
}
?>
