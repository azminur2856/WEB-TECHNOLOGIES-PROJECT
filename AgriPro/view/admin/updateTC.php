<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Dashboard</title>
    <script defer src="../../asset/js/admin/updateTerms.js"></script>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        include_once('../../model/tcModel.php');

        $termsContent = getTermsAndConditions();
    ?>
    <h3 style="text-align: center">Update Terms and Conditions</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
            <form id="updateTermsForm">
                <textarea id="termsText" name="terms" rows="10" cols="50"><?= htmlspecialchars($termsContent) ?></textarea><br><br>
                <button type="submit">Update Terms and Conditions</button>
            </form>
            <div id="updateMessage"></div>
          </td>
        </tr>
      </table>
  </body>
</html>