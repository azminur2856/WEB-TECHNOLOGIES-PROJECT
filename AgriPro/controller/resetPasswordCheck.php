<?php 
    session_start();
    require_once('../model/otpModel.php');
    require_once('../model/userModel.php');

    if (isset($_REQUEST['submit'])) {

        $otp = trim($_REQUEST['otp']);
        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST['password']);
        $repassword = trim($_REQUEST['repassword']);
        
        if (empty($otp)) {
            $_SESSION['otp_input_error'] = "OTP is required!";
        } else {
            if (strlen($otp) !== 6) {
                $_SESSION['otp_input_error'] = "OTP must be 6 digits!";
            }  else {
                for ($i = 0; $i < 6; $i++) {
                    if ($otp[$i] < '0' || $otp[$i] > '9') {
                        $_SESSION['otp_input_error'] = "OTP must contain only digits!";
                        break;
                    }
                }
            }
        }

        $otpData = getOtpData($email);

        if ($otpData) {
            if ($otpData['otp_code'] !== $otp) {
                $_SESSION['otp_input_error'] = "Invalid OTP!";
            } elseif (strtotime($otpData['expires_at']) < time()) {
                $_SESSION['otp_input_error'] = "OTP has expired!";
            } elseif ($otpData['is_used'] == 1) {
                $_SESSION['otp_input_error'] = "OTP has already been used!";
            }
        } else {
            $_SESSION['otp_input_error'] = "Failed to find OTP data for the provided email.";
        }

        if (empty($password)) {
            $_SESSION['password_error'] = "Password is required!";
        } else {
            $hasSpecialChar = false;
            for ($i = 0; $i < strlen($password); $i++) {
                if ($password[$i] === '@' || $password[$i] === '#' || $password[$i] === '$' || $password[$i] === '%') {
                    $hasSpecialChar = true;
                    break;
                }
            }

            if (strlen($password) < 8) {
                $_SESSION['password_error'] = "Password must be at least 8 characters long!";
            } elseif (!$hasSpecialChar) {
                $_SESSION['password_error'] = "Password must contain at least one special character (@, #, $, or %)!";
            } elseif ($password !== $repassword) {
                $_SESSION['password_error'] = "Passwords do not match!";
            }
        }

        if (!isset($_SESSION['otp_input_error']) && !isset($_SESSION['password_error'])) {
            if(markOtpAsUsed($email)) {
                if (updatePassword($email, $password)) {
                    $_SESSION['form_success'] = "Password reset successfully!";
                    header('location: ../view/signin.php');
                exit();
                } else {
                    $_SESSION['form_error'] = "Failed to reset password!";
                    header('location: ../view/resetPassword.php');
                    exit();
                }
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['otp'] = $otp;
                $_SESSION['password'] = $password;
                $_SESSION['form_error'] = "Please submit again!";
                header('location: ../view/resetPassword.php');
                exit();
            }       
        } else {
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;
            header('location: ../view/resetPassword.php');
            exit();
        }
    } else {
        header('location: ../view/resetPassword.php');
        exit();
    }
?>