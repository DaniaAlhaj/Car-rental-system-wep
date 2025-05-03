<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['damage_status'])) {
        $damage_status = $_POST['damage_status'];
$status='damged';
        include "dbconfig.php";


        $sql = "SELECT carid, car_type, car_make, photo FROM car WHERE status >= :$status";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Type</th>
                        <th>Car Make</th>
                        <th>Photo</th>
                    </tr>";
      
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>" . $row['carid'] . "</td>
                        <td>" . $row['car_type'] . "</td>
                        <td>" . $row['car_make'] . "</td>
                        <td><img src='" . $row['photo'] . "' alt='Car Photo' width='100'></td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No cars found with the specified damage status.";
        }
    }
}
?>
