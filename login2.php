<?php
session_start();

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('dbconfig.php');

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];
    $password_hashed = md5($password); 

    if (!empty($username) && !empty($password) && !empty($role)) {
        if ($role == 'manager') {
            $stmt = $pdo->prepare("SELECT * FROM manager WHERE adminname = :adminname AND adminpassword = :adminpassword");
            $stmt->bindParam(':adminname', $username);
            $stmt->bindParam(':adminpassword', $password);
            $stmt->execute();
            $manager = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($manager) {
                $_SESSION['logged_in'] = true;
                $managerId = $_SESSION['managerid'];
                $_SESSION['username'] = $manager['username'];
                $_SESSION['role'] = 'manager';

                header('Location: manager.php');
                exit;
            } else {
                $error_message = "Invalid manager username or password!";
            }
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
                $_SESSION['role'] = 'user';
                $_SESSION['name'] = $user['name'];
                $_SESSION['flat'] = $user['flat'];
                $_SESSION['street'] = $user['street'];
                $_SESSION['city'] = $user['city'];
                $_SESSION['country'] = $user['country'];
                $_SESSION['dateofBirth'] = $user['dob'];
                $_SESSION['idnumber'] = $user['id_number'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phone'] = $user['telephone'];
                $_SESSION['card_number'] = $user['card_number'];
                $_SESSION['expiry_date'] = $user['expiry_date'];
                $_SESSION['card_name'] = $user['card_name'];
                $_SESSION['bank_name'] = $user['bank_name'];

                $success_message = "Welcome, you have logged in successfully!";
            } else {
                $error_message = "Invalid username or password!";
            }
        }
    } else {
        $error_message = "All fields are required!";
    }

    $redirect_url = 'login.php';
    if (!empty($error_message)) {
        $redirect_url .= '?error_message=' . urlencode($error_message);
    } elseif (!empty($success_message)) {
        $redirect_url .= '?success_message=' . urlencode($success_message);
    }

    header('Location: ' . $redirect_url);
    exit;
}
?>
