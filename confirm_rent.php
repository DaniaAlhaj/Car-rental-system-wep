
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $cardName = $_POST['cardName'];
    $bankName = $_POST['bankName'];
    $cardType = $_POST['cardType'];
    $invoiceDate=$_POST['invoiceDate'];

    $_SESSION['card_number1'] = $cardNumber;
    $_SESSION['expiry_date2'] = $expiryDate;
    $_SESSION['card_name3'] = $cardName;
    $_SESSION['bank_name4'] = $bankName;
    $_SESSION['cardType5'] = $cardType;
    $_SESSION['invoiceDate']  = $invoiceDate;

    $carid=$_SESSION['carid'] ;

   $returnlocation = $_SESSION['dania'];
       
  if ($returnlocation==""){
    $returnlocation=$_SESSION['pickup-location'];
  }



    

    $startDate = $_SESSION['start-date'];
    $endDate = $_SESSION['end-date'];
    $totalAmount=$_SESSION['totalAmount'];
    $location = $_SESSION['pickup-location'];
    
    $additionalDriverCost = $_SESSION['additionalDrivercost'];

    $babySeatCost = $_SESSION['babySeatcost'];

    $changeLocationCost = $_SESSION['changelocationcost'];


   $additional_cost_details=$_SESSION['additional_cost_details'] . ' ';
 

    include_once "dbconfig.php";
    $userid = $_SESSION['userid'];
    
    try {
        $sql = "UPDATE credit_cards SET card_number = :cardNumber, expiry_date = :expiryDate, card_name = :cardName, bank_name = :bankName, cardtype = :cardType WHERE userid = :userid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'cardNumber' => $cardNumber,
            'expiryDate' => $expiryDate,
            'cardName' => $cardName,
            'bankName' => $bankName,
            'cardType' => $cardType,
            'userid' => $userid
        ]);
        $stmt = $pdo->prepare('INSERT INTO contract ( strartdate ,enddate,	carid	,userid
        	,total_price ,	extra_cost,invoicedate ,pickuplocation,returnlocation ) VALUES (?, ?,?, ?, ?, ?, ?,?,?)');
       $stmt->execute([
        $startDate,
        $endDate,
        $carid,
        $userid,
           $totalAmount,
           $additional_cost_details ,
           $invoiceDate,
           $location , 
           $returnlocation
       ]);
       $deleteQuery = "DELETE FROM basket WHERE userid = :userid AND carid = :carid";
$deleteStmt = $pdo->prepare($deleteQuery);
$deleteStmt->execute(['userid' => $userid, 'carid' => $carid]);

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error updating database: " . $e->getMessage();
    }
} 
?>

<?php
