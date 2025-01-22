<?php
    require_once('db.php');

    // Save OTP to Database
    function saveOtpToDatabase($userId, $otp, $expiresAt) {
        $con = getConnection();
    
        $otpSql = "UPDATE otps SET otp_code = '{$otp}', expires_at = '{$expiresAt}', otp_count = otp_count + 1, is_used = 0 WHERE user_id = {$userId}";
    
        if (mysqli_query($con, $otpSql)) {
            return true;
        } else {
            return false;
        }
    
        mysqli_close($con);
    }

    // Get OTP data by email
    function getOtpData($email) {
        $con = getConnection();
    
        $sql = "SELECT otps.otp_code, otps.expires_at, otps.is_used FROM otps JOIN users ON otps.user_id = users.id WHERE users.email = '{$email}'";
    
        $result = mysqli_query($con, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    
        mysqli_close($con);
    }

    // Mark OTP as used
    function markOtpAsUsed($email) {
        $con = getConnection();
    
        $otpSql = "UPDATE otps SET is_used = 1 WHERE user_id = (SELECT id FROM users WHERE email = '{$email}')";
    
        if (mysqli_query($con, $otpSql)) {
            return true;
        } else {
            return false;
        }
    
        mysqli_close($con);
    }
?>