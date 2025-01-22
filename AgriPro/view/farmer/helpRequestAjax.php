<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="../../asset/css/farmer/helpRequest.css">
    <script src="../../asset/js/farmer/helpRequestAjax.js"></script>
  </head>
  <body>
    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        $email = $_SESSION['farmerEmail'];
        $user = getUserByEmail($email);
        if (!$user) {
            $_SESSION['form_error'] = "User not found!";
            exit;
        }
    ?>
    <h3 style="text-align: center">Help Request</h3>
    <hr />
    <form id="helpRequestForm">
        <table align="right" id="helpRequest" class="table-st" cellspacing="0" width="70%">
            <!-- Success and Error Messages -->
            <tr>
                <td id="errorTD" style="color: green" colspan="2" align="center">
                    <span id="formSuccess"></span>
                </td>
            </tr>
            <tr>
                <td class="jsError" id="errorTD" style="color: red;" colspan="2" align="center">
                    <span id="formError"></span>
                    <ul id="errorList"></ul>
                </td>
            </tr>
            <!-- Name -->
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" value="<?= $user['name'] ?>" readonly /></td>
            </tr>
            <!-- Email -->
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" value="<?= $user['email'] ?>" readonly /></td>
            </tr>
            <!-- Category -->
            <tr>
                <td><label for="category">Select Help Category:</label></td>
                <td>
                    <select id="category" name="category">
                        <option value="">Select Category...</option>
                        <option value="General Support">General Support</option>
                        <option value="Crop Health">Crop Health</option>
                        <option value="Soil Health">Soil Health</option>
                        <option value="Irrigation and Water Management">Irrigation and Water Management</option>
                        <option value="Farm Equipment and Technology">Farm Equipment and Technology</option>
                    </select>
                </td>
            </tr>
            <!-- Query -->
            <tr>
                <td><label for="query">Query:</label></td>
                <td><textarea id="query" name="query" rows="4" cols="50"></textarea></td>
            </tr>
            <!-- Submit Button -->
            <tr>
                <td colspan="2" align="center">
                    <button type="button" onclick="submitHelpRequest()" class="helpButton">Submit Request</button>
                </td>
            </tr>
        </table>
    </form>
  </body>
</html>
