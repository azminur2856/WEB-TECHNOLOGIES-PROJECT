<?php include_once "header.php"; session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" href="../asset/css/resetPassword.css">
        <script src="../asset/js/otpRequestCheck.js"></script>
        <script src="../asset/js/resetPasswordCheck.js"></script>
    </head>
    <body>
        <h1 align="center">Reset Password</h1>
        <form method="post" action="../controller/otpRequestCheck.php" onsubmit="return validateOtpRequestForm()">
            <table align="center" id="otpRequest">
                <tr>
                    <td id="ff">
                        <input type="email" id="email" name="email" placeholder="Enter your email address" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="center" id="errorTD" style="color: red;">
                        <?= isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>
                        <?= isset($_SESSION['otp_error']) ? $_SESSION['otp_error'] : ''; ?>
                    </td>
                </tr>
                <tr>
                    <td td align="center" id="errorTD" style="color: green;">
                    <?= isset($_SESSION['otpStatus']) ? 'OTP sent successfully!' : ''; ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <input type="submit" name="submit" value="Send OTP" />
                    </td>
                </tr>
            </table>
        </form>  
        <form method="post" action="../controller/resetPasswordCheck.php" onsubmit="return validateResetPasswordForm()">
            <table align="center" id="resetPassword">
                <tr>
                    <td id="errorTD" style="color: red;"><?php isset($_SESSION['form_error']) ? $_SESSION['form_error'] : ''; ?></td>
                <tr>
                    <td><input type="text" id="otp" name="otp" placeholder="Enter the OTP" /></td>
                </tr>
                <tr>
                    <td id="errorTD" style="color: red;">
                        <?= isset($_SESSION['otp_input_error']) ? $_SESSION['otp_input_error'] : ''; ?>
                    </td>
                </tr>
                <tr>
                    <td><input type="hidden" id="hemail" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" /></td>
                </tr>
                <tr>
                    <td><input type="password" id="password" name="password" placeholder="Enter new password" /></td>
                </tr>
                <tr>
                    <td id="errorTD" style="color: red;">
                        <?= isset($_SESSION['password_error']) ? $_SESSION['password_error'] : ''; ?>
                    </td>
                </tr>
                <tr>
                    <td><input type="password" id="repassword" name="repassword" placeholder="Confirm new password" /></td>
                </tr>
                <tr>
                    <td style="text-align: center"><input type="submit" name="submit" value="Reset Password" /></td>
                </tr>
            </table>
            <div id="jsErrorOTP">
                <ul id="errorListOTP">
                </ul>
            </div>
            <div id="jsErrorReset">
                <ul id="errorListReset">
                </ul>
            </div>
        </form>
        <?php
            unset($_SESSION['email']);
            unset($_SESSION['otpStatus']);
            unset($_SESSION['email_error']);
            unset($_SESSION['otp_error']);
            unset($_SESSION['otp_input_error']);
            unset($_SESSION['password_error']);
            unset($_SESSION['form_error']);
        ?> 
    </body>
</html>
<?php include_once "footer.php"; ?>