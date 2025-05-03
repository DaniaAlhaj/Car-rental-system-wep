<?php
session_start();


include_once "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['carid']=$_POST['carid'];

}
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $carid=$_SESSION['carid'];
$userid=$_SESSION['userid'];

$_SESSION['is_clicked_rent']=$carid;
$_SESSION['is_clicked_rent']=$carid;

$query = "SELECT COUNT(*) FROM basket WHERE userid = :userid AND carid = :carid";
$stmt = $pdo->prepare($query);
$stmt->execute(['userid' => $userid, 'carid' => $carid]);
$count = $stmt->fetchColumn();


if ($count == 0) {
    $stmt = $pdo->prepare('INSERT INTO basket ( userid ,carid) VALUES (?, ?)');
    $stmt->execute([
    $userid,
     
    $carid
    ]);
}

    header("Location: rentcar.php");
    exit();
} else {
    header("Location: loginrent.php");
    exit();
}
?>
