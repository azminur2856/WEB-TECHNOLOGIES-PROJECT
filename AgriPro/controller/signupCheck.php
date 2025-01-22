<?php 
    session_start();
    require_once('../model/userModel.php');
    require_once('../controller/Email/checkEmailExistence.php');

    if (isset($_REQUEST['submit'])) {

        $type = isset($_REQUEST['type']) ? trim($_REQUEST['type']) : '';
        $name = trim($_REQUEST['name']);
        $email = trim($_REQUEST['email']);
        $phone = trim($_REQUEST['phone']);
        $dob = isset($_REQUEST['dob']) ? trim($_REQUEST['dob']) : '';
        $gender = isset($_REQUEST['gender']) ? trim($_REQUEST['gender']) : '';
        $password = trim($_REQUEST['password']);
        $repassword = trim($_REQUEST['repassword']);
        $agree = isset($_REQUEST['agree']);

        $image = $_FILES['picture'];

        if (empty($name)) {
            $_SESSION['name_error'] = "Name is required!";
        } else {
            $valid = true;
        
            $parts = explode(' ', $name);
        
            foreach ($parts as $part) {
                if (empty($part) || $part[0] < 'A' || $part[0] > 'Z' || !ctype_alpha($part)) {
                    $valid = false;
                    break;
                }
            }      
            if (!$valid) {
                $_SESSION['name_error'] = "All Parts of Name must start with a capital letter and contain only alphabetic characters!";
            }
        }        

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
            } elseif (isEmailRegistered($email)) {
                $_SESSION['email_error'] = "Email is already registered!";
            } elseif(!isEmailExists($email)){
                $_SESSION['email_error'] = "Email is not exists!";
            }
        }

        if (empty($phone)) {
            $_SESSION['phone_error'] = "Phone number is required!";
        } else {
            if (strlen($phone) !== 10) {
                $_SESSION['phone_error'] = "Phone number must be exactly 10 digits long!";
            } elseif ($phone[0] !== '1') {
                $_SESSION['phone_error'] = "Phone number must start with '1'!";
            } elseif ($phone[1] < '3' || $phone[1] > '9') {
                $_SESSION['phone_error'] = "The second digit must be between '3' and '9'!";
            } else {
                for ($i = 2; $i < 10; $i++) {
                    if ($phone[$i] < '0' || $phone[$i] > '9') {
                        $_SESSION['phone_error'] = "Phone number must contain only digits!";
                        break;
                    }
                }
            }
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

        if (empty($type)) {
            $_SESSION['type_error'] = "User type is required!";
        }

        if (empty($dob)) {
            $_SESSION['dob_error'] = "Date of birth is required!";
        } else {
            $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
            $currentDate = new DateTime();
    
            if (!$dobDate || $dobDate > $currentDate) {
                $_SESSION['dob_error'] = "Invalid or future date!";
            } else {
                $age = $currentDate->diff($dobDate)->y;
                if ($currentDate->format('m-d') < $dobDate->format('m-d')) {
                    $age--;
                }                   
                if ($age < 18) {
                    $_SESSION['dob_error'] = "Applicant must be at least 18 years old!";
                }
            }
        }

        if (empty($gender)) {
            $_SESSION['gender_error'] = "Gender is required!";
        }

        if (!$agree) {
            $_SESSION['agree_error'] = "You must agree to the terms and conditions!";
        }

        if (!empty($image['name'])) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);

            if (!in_array($fileExtension, $allowedExtensions)) {
                $_SESSION['image_error'] = "Invalid image format! Only jpg, jpeg, and png are allowed.";
            } else{
                $file_name = '+880' . $phone . '.' . $fileExtension;
                $src = $image['tmp_name'];
                $directory = '../asset/image/' . strtolower($type) . '/';
                $des = $directory . $file_name;
                
                if (!move_uploaded_file($src, $des)) {
                    $_SESSION['image_error'] = "Failed to upload profile picture!";
                }
            }
        } else {
            $_SESSION['image_error'] = "Profile picture is required!";
        }

        if (!isset($_SESSION['name_error']) && !isset($_SESSION['email_error']) && !isset($_SESSION['phone_error'])
            && !isset($_SESSION['password_error']) && !isset($_SESSION['type_error']) && !isset($_SESSION['dob_error'])
            && !isset($_SESSION['gender_error']) && !isset($_SESSION['agree_error']) && !isset($_SESSION['image_error'])) {

            $ccphone = '+880' . $phone;
            $status = signup($type, $name, $email, $ccphone, $dob, $gender, $password, $file_name);

            if ($status) {
                $_SESSION['form_success'] = "Sign Up Successful!</br>Please Sign In to Continue.";
                header('location: ../view/signin.php');
                exit();
            } else {
                if (!empty($file_name) && file_exists($des)) {
                    unlink($des);
                }

                $_SESSION['form_error'] = "Failed to Sign Up. Please try again later.";
                header('location: ../view/signup.php');
                exit();
            }
        } else {
            if (!empty($file_name) && file_exists($des)) {
                unlink($des);
            }
            $_SESSION['type'] = $type;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['dob'] = $dob;
            $_SESSION['gender'] = $gender;
            $_SESSION['agree'] = $agree;

            header('location: ../view/signup.php');
            exit();
        }
    } else {
        header('location: ../view/signup.php');
        exit();
    }
?>