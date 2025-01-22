<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
    ?>
    <h3 style="text-align: center">Fertilizer Calculator</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
            <!-- Form for input -->
            <form id="fertilizerForm">
                <label for="land_size">Land Size (in satak):</label>
                <input type="number" id="land_size" name="land_size" value="" step="0.01">
                <br><br>
                <label for="crop_type">Select Crop:</label>
                <select id="crop_type" name="crop_type" required>
                    <option value="">--Select Crop--</option>
                    <option value="wheat">Wheat</option>
                    <option value="rice">Rice</option>
                    <option value="tomato">Tomato</option>
                    <option value="maize">Maize</option>
                    <option value="potato">Potato</option>
                    <option value="onion">Onion</option>
                    <option value="soybean">Soybean</option>
                    <option value="barley">Barley</option>
                    <option value="sugarcane">Sugarcane</option>
                    <option value="cotton">Cotton</option>
                </select>
                <br><br>
                <button type="submit">Calculate</button>
            </form>
        
            <div id="results"></div> <!-- This will display the results -->
        
            <script src="../../asset/js/farmer/fartilizerInformation.js"></script>
          </td>
        </tr>
      </table>
  </body>
</html>