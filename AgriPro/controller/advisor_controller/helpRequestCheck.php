<?php
    session_start();
    require_once('../../model/userModel.php');
    require_once('../../model/advisorModel.php');


    if(isset($_REQUEST['submit'])){
        $name = trim($_REQUEST['name']);
        $email = trim($_REQUEST['email']);
        $category = isset($_REQUEST['category']) ? trim($_REQUEST['category']) : '';
        $query = trim($_REQUEST['query']);

        if (empty($name)) {
            $_SESSION['name_error'] = "Name is required!";
        } else {
            $valid = true;
        
            // Split the name into parts by space
            $parts = explode(' ', $name);
        
            foreach ($parts as $part) {
                // Check if the part is non-empty, starts with a capital letter, and contains only letters
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
            }
        }

        if (empty($category)) {
            $_SESSION['category_error'] = "Category is required!";
        }

        if (empty($query)) {
            $_SESSION['query_error'] = "Query is required!";
        } else {
            $wordCount = str_word_count($query);
            if ($wordCount < 5) {
                $_SESSION['query_error'] = "Query must contain at least 5 words!";
            }
        }

        if (!isset($_SESSION['name_error']) && !isset($_SESSION['email_error']) && !isset($_SESSION['category_error']) && !isset($_SESSION['query_error'])) {
            $user = getUserByEmail($email);

            if($user) {
                $userId = $user['id'];
                $status = helpRequest($userId, $category, $query);
                
                if ($status) {
                    $_SESSION['form_success'] = "Help Request Submitted Successfully!";
                    header('location: ../../view/advisor/helpRequest.php');
                    exit();
                } else {
                    $_SESSION['category'] = $category;
                    $_SESSION['query'] = $query;
                    $_SESSION['form_error'] = "Failed to submit help request.</br>Please try again!";
                    header('location: ../../view/advisor/helpRequest.php');
                    exit();
                }
            } else {
                $_SESSION['form_error'] = "Failed to find user for the provided email.";
                header('location: ../../view/advisor/helpRequest.php');
                exit();
            }

        } else {
            $_SESSION['category'] = $category;
            $_SESSION['query'] = $query;
            header('location: ../../view/advisor/helpRequest.php');
            exit();
        } 
    } else {
        header('location: ../../view/advisor/helpRequest.php');
        exit();
    }
?>