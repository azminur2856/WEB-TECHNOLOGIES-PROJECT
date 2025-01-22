<?php include_once "header.php"; session_start(); ?>

<html lang="en">
  <head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../asset/css/signup.css">
    <script src="../asset/js/signupCheck.js"></script>
  </head>  

  <body>
    <table align="center" width="100%">
      <tr>
        <td width="50%" align="center">
          <form
            action="../controller/signupCheck.php"
            method="POST"
            enctype="multipart/form-data"
            onsubmit="return validateSignupForm()"
          >
          <h1 align="center">Sign Up</h1>
          <div align="center" class="mainDiv">
              <!-- <br /><br /><br /> -->
              <table>
                <!-- Form Error -->
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['form_error']) ? $_SESSION['form_error'] : ''; ?>
                  </td>
                </tr>
                <!-- User Type -->
                <tr>
                  <td>User Type:</td>
                  <td id="ff">
                    <input type="radio" name="type" value="Admin" <?= isset($_SESSION['type']) && $_SESSION['type'] === 'Admin' ? 'checked' : '' ?> /> Admin
                    <input type="radio" name="type" value="Advisor" <?= isset($_SESSION['type']) && $_SESSION['type'] === 'Advisor' ? 'checked' : '' ?> /> Advisor
                    <input type="radio" name="type" value="Farmer" <?= isset($_SESSION['type']) && $_SESSION['type'] === 'Farmer' ? 'checked' : '' ?> /> Farmer
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['type_error']) ? $_SESSION['type_error'] : ''; ?>
                  </td>
                </tr>
                <!-- Name -->
                <tr>
                  <td>Name:</td>
                  <td id="ff">
                    <input type="text" id="name" name="name" value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>" />
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['name_error']) ? $_SESSION['name_error'] : ''; ?>
                  </td>
                </tr>
                <!-- Email -->
                <tr>
                  <td>Email:</td>
                  <td id="ff">
                    <input type="email" id="email" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" />
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>
                  </td>
                </tr>
                <!-- Phone Number -->
                <tr>
                  <td>Phone No:</td>
                  <td id="ff">
                    <label>+880</label>
                    <input
                      type="text"
                      id="phone"
                      name="phone"
                      placeholder="1XXXXXXXXX"
                      maxlength="10"
                      value="<?= isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ?>"
                    />
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['phone_error']) ? $_SESSION['phone_error'] : ''; ?>
                  </td>
                </tr>
                <!-- DOB -->
                <tr>
                  <td>DOB:</td>
                  <td id="ff">
                    <input type="date" id="dob" name="dob" value="<?= isset($_SESSION['dob']) ? $_SESSION['dob'] : '' ?>" />
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['dob_error']) ? $_SESSION['dob_error'] : ''; ?>
                  </td>
                </tr>
                <!-- Gender -->
                <tr>
                  <td>Gender:</td>
                  <td id="ff">
                    <input type="radio" name="gender" value="Male" <?= isset($_SESSION['gender']) && $_SESSION['gender'] === 'Male' ? 'checked' : '' ?> /> Male
                    <input type="radio" name="gender" value="Female" <?= isset($_SESSION['gender']) && $_SESSION['gender'] === 'Female' ? 'checked' : '' ?> /> Female
                    <input type="radio" name="gender" value="Other" <?= isset($_SESSION['gender']) && $_SESSION['gender'] === 'Other' ? 'checked' : '' ?> /> Other
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['gender_error']) ? $_SESSION['gender_error'] : ''; ?>
                  </td>
                </tr>
                <!-- Profile Picture -->
                <tr>
                  <td>Profile Picture:</td>
                  <td id="ff">
                    <input type="file" id="picture" name="picture" />
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['image_error']) ? $_SESSION['image_error'] : ''; ?>
                  </td>
                </tr>
                <!-- Password -->
                <tr>
                  <td>Password:</td>
                  <td id="ff">
                    <input type="password" id="password" name="password" />
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['password_error']) ? $_SESSION['password_error'] : ''; ?>
                  </td>
                </tr>
                <!-- Re-enter Password -->
                <tr>
                  <td>Re-enter Password:</td>
                  <td id="ff">
                    <input type="password" id="repassword" name="repassword" />
                  </td>
                </tr>
                <!-- Terms and Conditions -->
                <tr>
                  <td></td>
                  <td id="ff">
                    <input type="checkbox" id="agree" name="agree" <?= isset($_SESSION['agree']) && $_SESSION['agree'] === true ? 'checked' : '' ?> />
                    I agree to the <a href="tc.php">Terms and Conditions</a>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td id="errorTD" style="color: red;">
                    <?= isset($_SESSION['agree_error']) ? $_SESSION['agree_error'] : ''; ?>
                  </td>
                </tr>
                <!-- Submit and Sign Up -->
                <tr>
                  <td colspan="2" align="center">
                    <input type="submit" name="submit" class="regButton" value="Sign Up" />
                  </td>
                </tr>
              </table>
            </div>
          </form>
        </td>
      </tr>
    </table>
    <!-- js error show -->
    <div id="jsError">
      <ul id="errorList">
      </ul>
    </div>

    <?php
      // Clear session variables after rendering
      unset($_SESSION['form_error']);
      unset($_SESSION['type']);
      unset($_SESSION['type_error']);
      unset($_SESSION['name']);
      unset($_SESSION['name_error']);
      unset($_SESSION['email']);
      unset($_SESSION['email_error']);
      unset($_SESSION['phone']);
      unset($_SESSION['phone_error']);
      unset($_SESSION['dob']);
      unset($_SESSION['dob_error']);
      unset($_SESSION['gender']);
      unset($_SESSION['gender_error']);
      unset($_SESSION['agree']);
      unset($_SESSION['agree_error']);
      unset($_SESSION['image_error']);
      unset($_SESSION['password_error']);
    ?>
  </body>
</html>

<?php include_once "footer.php"; ?>
