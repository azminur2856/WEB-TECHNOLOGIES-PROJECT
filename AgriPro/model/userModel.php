<?php
    require_once('db.php');

    // User Sign Up
    function signup($type, $name, $email, $phone, $dob, $gender, $password, $imagePath) {
        $con = getConnection();
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        $userSql = "INSERT INTO users (user_type, name, email, phone, dob, gender, password_hash, profile_picture) 
                    VALUES ('{$type}', '{$name}', '{$email}', '{$phone}', '{$dob}', '{$gender}', '{$hashedPassword}', '{$imagePath}')";
    
        if (mysqli_query($con, $userSql)) {
            $idQuery = "SELECT id FROM users WHERE email = '{$email}'";
            $result = mysqli_query($con, $idQuery);
    
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $userId = $row['id'];
    
                $otpSql = "INSERT INTO otps (user_id) VALUES ({$userId})";
    
                if (mysqli_query($con, $otpSql)) {
                    return true;
                } else {
                    mysqli_query($con, "DELETE FROM users WHERE id = {$userId}");
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    
        mysqli_close($con);
    }

    // User Sign In
    function signin($email, $password) {
        $con = getConnection();

        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $result = mysqli_query($con, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password_hash'])) {
                return [
                    'status' => true,
                    'type' => $user['user_type'],
                ];
            } else {
                return ['status' => false];
            }
        } else {
            return ['status' => false];
        }
    }

    // User Email check
    function isEmailRegistered($email){
        $con = getConnection();
        $sql = "SELECT * FROM Users WHERE email = '{$email}'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0){
            return true;
        } else {
            return false;
        }
    }
    
    // Get User by Email
    function getUserByEmail($email){
        $con = getConnection();
        $sql = "SELECT * FROM Users WHERE email = '{$email}'";
        $result = mysqli_query($con, $sql);
        if($result && mysqli_num_rows($result) > 0){
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }

    // Update password
    function updatePassword($email, $password) {
        $con = getConnection();
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        $updatePasswordSql = "UPDATE users SET password_hash = '{$hashedPassword}' WHERE email = '{$email}'";
    
        if (mysqli_query($con, $updatePasswordSql)) {
            return true;
        } else {
            return false;
        }
    }



    // JOAR Part
    function getAllAdvisors() {
        $con = getConnection();
        $sql = "SELECT * FROM users WHERE user_type = 'Advisor'";
        $result = mysqli_query($con, $sql);
   
        $advisors = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($advisors, $row);
        }
   
        return $advisors;
    }
?>