<?php include_once "header.php"; session_start(); ?>
<?php require_once('../controller/encryptionDecryption.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="../asset/css/signin.css">
    <script src="../asset/js/signinCheck.js"></script>
  </head>
  <body>
    <h1 align="center">Sign In</h1>
    <form method="post" action="../controller/signinCheck.php" onsubmit="return validateSigninForm()">
      <table align="center" id="signinTable">
        <tr>
          <td style="color: green" colspan="2" align="center">
            <?php echo isset($_SESSION['form_success']) ? $_SESSION['form_success'] : ''; ?>
          </td>
        </tr>
        <tr>
          <td>Email:</td>
          <td>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_COOKIE['user_email']) ? decryptData($_COOKIE['user_email']) : ''); ?>" />
          </td>
        </tr>
        <tr>
          <td></td>
          <td style="color: red;">
            <?php echo isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>
          </td> 
        </tr>
        <tr>
          <td>Password:</td>
          <td>
            <input type="password" id="password" name="password" value="<?php echo isset($_COOKIE['user_password']) ? decryptData($_COOKIE['user_password']) : ''; ?>" />
          </td>
        </tr>
        <tr>
          <td></td>
          <td style="color: red;">
            <?php echo isset($_SESSION['password_error']) ? $_SESSION['password_error'] : ''; ?>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="checkbox" name="remember" value="1" <?php echo isset($_COOKIE['user_email']) ? 'checked' : ''; ?> /> Remember Me
          </td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center">
            <input type="submit" name="submit" value="Sign In" />
          </td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center">
            <a href="resetPassword.php">Can’t access your account?</a>
          </td>
        </tr>
      </table>
      <?php
        unset($_SESSION['form_success']);
        unset($_SESSION['email_error']);
        unset($_SESSION['password_error']);
        unset($_SESSION['email']);
      ?>
    </form>
    <div id="jsError">
      <ul id="errorList">
      </ul>
    </div>
  </body>
</html>
<?php include_once "footer.php"; ?>