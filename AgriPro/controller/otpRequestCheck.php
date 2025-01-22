<?php 
    session_start();
    require_once('../model/userModel.php');
    require_once('../model/otpModel.php');
    require_once('../controller/Email/sendOtpEmail.php');

    if (isset($_REQUEST['submit'])) {

        $email = trim($_REQUEST['email']);        

        if (empty($email)) {
            $_SESSION['email_error'] = "Email is required!";
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

        if (!isset($_SESSION['email_error'])) {
            $user = getUserByEmail($email);

            if($user) {
                $userId = $user['id'];

                $otp = rand(100000, 999999);
                $expiresAt = date('Y-m-d H:i:s', strtotime('+5 minutes')); // OTP expires in 5 minutes

                if (saveOtpToDatabase($userId, $otp, $expiresAt)) {
                    if (sendOtpToEmail($email, $otp, $expiresAt)) {
                        $_SESSION['email'] = $email;
                        $_SESSION['otpStatus'] = true;
                        header('location: ../view/resetPassword.php');
                        exit();
                    } else {
                        $_SESSION['otp_error'] = "Failed to send OTP. Please try again!";
                    }
                } else {
                    $_SESSION['otp_error'] = "Failed to save OTP. Please try again!";
                }
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['email_error'] = "Failed to find user for the provided email.";
            } 
        }else {
            $_SESSION['email'] = $email;
            header('location: ../view/resetPassword.php');
            exit();
        }
    } else {
        header('location: ../view/resetPassword.php');
        exit();
    }
?>