<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="../../asset/css/farmer/helpRequest.css">
    <script src="../../asset/js/farmer/helpRequestCheck.js"></script>
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
    <form action="../../controller/farmer_controller/helpRequestCheck.php" method="post" onsubmit="return validateHelpRequestForm()">
        <table align="right" id="helpRequest" class="table-st" cellspacing="0" width="70%">
            <!-- Form Success or Error -->
            <tr>
                  <td id="errorTD" style="color: green" colspan="2" align="center">
                    <?= isset($_SESSION['form_success']) ? $_SESSION['form_success'] : ''; ?>
                  </td>
            </tr>
            <tr>
                  <td class="jsError" id="errorTD" style="color: red;" colspan="2" align="center">
                    <?= isset($_SESSION['form_error']) ? $_SESSION['form_error'] : ''; ?>
                    <ul id="errorList">
                    </ul>
                  </td>
            </tr>
            <!-- Name -->
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" value="<?= $user['name'] ?>" readonly /></td>
            </tr>
            <tr>
                <td></td>
                <td id="errorTD" style="color: red;">
                <?= isset($_SESSION['name_error']) ? $_SESSION['name_error'] : ''; ?>
                </td>
            </tr>
            <!-- Email -->
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" value="<?= $user['email'] ?>" readonly /></td>
            </tr>
            <tr>
                <td></td>
                <td id="errorTD" style="color: red;">
                <?= isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>
                </td>
            </tr>
            <!-- Category -->
            <tr>
                <td><label for="category">Select Help Category:</label></td>
                <td>
                    <select id="category" name="category">
                        <option value="" <?= !isset($_SESSION['category']) || $_SESSION['category'] === '' ? 'selected' : '' ?>>Select Category...</option>
                        <option value="General Support" <?= isset($_SESSION['category']) && $_SESSION['category'] === 'General Support' ? 'selected' : '' ?>>General Support</option>
                        <option value="Crop Health" <?= isset($_SESSION['category']) && $_SESSION['category'] === 'Crop Health' ? 'selected' : '' ?>>Crop Health</option>
                        <option value="Soil Health" <?= isset($_SESSION['category']) && $_SESSION['category'] === 'Soil Health' ? 'selected' : '' ?>>Soil Health</option>
                        <option value="Irrigation and Water Management" <?= isset($_SESSION['category']) && $_SESSION['category'] === 'Irrigation and Water Management' ? 'selected' : '' ?>>Irrigation and Water Management</option>
                        <option value="Farm Equipment and Technology" <?= isset($_SESSION['category']) && $_SESSION['category'] === 'Farm Equipment and Technology' ? 'selected' : '' ?>>Farm Equipment and Technology</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td id="errorTD" style="color: red;">
                <?= isset($_SESSION['category_error']) ? $_SESSION['category_error'] : ''; ?>
                </td>
            </tr>
            <!-- Query -->
            <tr>
                <td><label for="query">Query:</label></td>
                <td><textarea id="query" name="query" rows="4" cols="50"><?= isset($_SESSION['query']) ? $_SESSION['query'] : '' ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td id="errorTD" style="color: red;">
                <?= isset($_SESSION['query_error']) ? $_SESSION['query_error'] : ''; ?>
                </td>
            </tr>
            <!-- Submit Button -->
            <tr>
                <td colspan="2" align="center">
                <input type="submit" name="submit" class="helpButton" value="Submit Request" />
                </td>
            </tr>
        </table>
        <?php
            unset($_SESSION['category']);
            unset($_SESSION['query']);
            unset($_SESSION['form_success']);
            unset($_SESSION['form_error']);
            unset($_SESSION['name_error']);
            unset($_SESSION['email_error']);
            unset($_SESSION['category_error']);
            unset($_SESSION['query_error']);
        ?>
    </form>
  </body>
</html>