<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
    <script src="../../asset/js/farmer/appointment.js"></script>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');

        require_once('../../model/user.php');
        require_once('../../model/appointment.php');
        require_once('../../model/confirmed_appointment.php');

        $advisors = getAdvisors();
    ?>
    <h3 style="text-align: center">Take Appoinment</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
          <h2>Book an Appointment</h2>
                  <form id="appointmentForm" method="post">
                  <label for="advisor">Advisor Name:</label>
                  <select id="advisor" name="advisor_id" required>
                      <option value="">Select an Advisor</option>
                      <?php
                      if (!empty($advisors)) {
                          foreach ($advisors as $advisor) {
                              echo '<option value="' . htmlspecialchars($advisor['id']) . '">' . htmlspecialchars($advisor['name']) . '</option>';
                          }
                      } else {
                          echo '<option value="">No advisors available</option>';
                      }
                      ?>
                  </select>
                  <span></span><br><br>
              
                  <label for="phone">Phone Number:</label>
                  <input type="tel" id="phone" name="phone_number" required>
                  <small>Format: 01232728365 (only 11 digits)</small>
                  <span></span><br><br>
              
                  <label for="date">Preferred Date:</label>
                  <input type="date" id="date" name="appointment_date" required>
                  <span></span><br><br>
              
                  <label for="time">Preferred Time:</label>
                  <input type="time" id="time" name="appointment_time" required>
                  <span></span><br><br>
              
                  <label for="service">Service:</label>
                  <select id="service" name="service" required>
                      <option value="">Select a Service</option>
                      <option value="Soil Management">Soil Management</option>
                      <option value="Pest Control">Pest Control</option>
                      <option value="Crop Monitoring">Crop Monitoring</option>
                      <option value="Irrigation Planning">Irrigation Planning</option>
                      <option value="Weather Advisory">Weather Advisory</option>
                  </select>
                  <span></span><br><br>
              
                  <label for="details">Additional Details:</label>
                  <textarea id="details" name="details" rows="4" cols="50" required></textarea>
                  <span></span><br><br>
              
                  <button type="button" id="submitBtn">Book Appointment</button>
              </form>
              
              <div id="message"></div>
          </td>
        </tr>
      </table>
  </body>
</html>
 
 