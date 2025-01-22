<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
    <script src="../../asset/js/farmer/cropDirectoryView.js" defer></script>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
    ?>
    <h3 style="text-align: center">Crop Directory</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
            <p>Welcome! Click on a crop name to learn more about it.</p>
            <table id="cropTable">
                <!-- Dynamic content will be inserted here -->
            </table>
          </td>
        </tr>
      </table>
  </body>
</html>