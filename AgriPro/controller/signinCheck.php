<?php 
    session_start();
    require_once('../model/userModel.php');
    require_once('encryptionDecryption.php');

    if (isset($_REQUEST['submit'])) {
        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST['password']);

        if (empty($email)) {
            $_SESSION['email_error'] = "Email cannot be empty!";
        } else {
            $hasAt = false;
            $hasDot = false;
            for ($i = 0; $i < strlen($email); $i++) {
                if ($email[$i] === '@') {
                    $hasAt = true;
                }
                if ($email[$i] === '.') {
                    $hasDot = true;
                }
            }
            if (!$hasAt || !$hasDot) {
                $_SESSION['email_error'] = "Invalid email format!";
            } elseif (!isEmailRegistered($email)) {
                $_SESSION['email_error'] = "User not found!";
            }
        }

        if (empty($password)) {
            $_SESSION['password_error'] = "Password cannot be empty!";
        }

        if (!isset($_SESSION['email_error']) && !isset($_SESSION['password_error'])){
            $loginResult = signin($email, $password);

            if($loginResult['status']){
                if (isset($_POST['remember']) && $_POST['remember'] == '1') {
                    setcookie('user_email', encryptData($email), time() + (86400 * 30), "/"); // 30 days
                    setcookie('user_password', encryptData($password), time() + (86400 * 30), "/"); // 30 days
                } else {
                    setcookie('user_email', '', time() - 3600, "/"); // Expire
                    setcookie('user_password', '', time() - 3600, "/"); // Expire
                }
                if($loginResult['type'] === 'Admin'){
                    $_SESSION['adminStatus'] = true;
                    $_SESSION['adminEmail'] = $email;
                    header('location: ../view/admin/viewDashboard.php');
                }elseif($loginResult['type'] === 'Advisor'){
                    $_SESSION['advisorStatus'] = true;
                    $_SESSION['advisorEmail'] = $email;
                    header('location: ../view/advisor/viewDashboard.php');
                }elseif($loginResult['type'] === 'Farmer'){
                    $_SESSION['farmerStatus'] = true;
                    $_SESSION['farmerEmail'] = $email;
                    header('location: ../view/farmer/viewDashboard.php');
                }
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['password_error'] = "Invalid password!";
                header('location: ../view/signin.php');
                exit();
            }
        } else {
            $_SESSION['email'] = $email;
            header('location: ../view/signin.php');
            exit();
        }
        } else {
        header('location: ../view/signin.php');
        exit();
    }
?>
