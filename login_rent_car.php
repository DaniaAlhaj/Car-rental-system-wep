<?php
session_start();

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('dbconfig.php');

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password_hashed = md5($password); 

    if (!empty($username) && !empty($password)) {
        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;

            header('Location: admin.php');
            exit;
        } else {
            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username AND user_password = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password_hashed);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['logged_in'] = true;
                $_SESSION['userid'] = $user['userid'];
                $_SESSION['username'] = $user['username'];
                $success_message = "Welcome, you have logged in successfully!";
                if ($_SESSION['regester']=true){
                    $_SESSION['username'] =  $user['name'];
                    $_SESSION['flat'] = $user['flat'];
                    $_SESSION['street'] =$user['street'];
                    $_SESSION['city'] = $user['city'];
                    $_SESSION['country'] = $user['country'];
                    $_SESSION['dateofBirth'] = $user['dob'];
                    $_SESSION['idnumber'] = $user['id_number'];
                    $_SESSION['email'] =$user['email'];
                    $_SESSION['phone'] = $user['telephone'];
                    $_SESSION['card_number'] =$user['card_number'];
                    $_SESSION['expiry_date'] = $user['expiry_date'];
                    $_SESSION['card_name'] =$user['card_name'];
                    $_SESSION['bank_name'] = $user['bank_name'];
                                }
                                $carid=$_SESSION['carid'];
$userid=$_SESSION['userid'];



            } 
            
            
            
            
            else {
                $error_message = "Invalid username or password!";
            }
        }
    } else {
        $error_message = "Both fields are required!";
    }

   
    header('Location: ' . 'rentcar.php');
    exit;
}
?>
