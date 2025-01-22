<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Advisor Dashboard</title>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        require_once('../../model/user.php');
        require_once('../../model/appointment.php');
        require_once('../../model/confirmed_appointment.php');
        $appointment_id = $_SESSION['reschedule_appointment_id'];
        $appointment = getAppointmentById($appointment_id);
    ?>
    <h3 style="text-align: center">Reschedule Appointment</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
            <?php if ($appointment): ?>
                <form id="reschedule-form">
                    <input type="hidden" id="appointment_id" value="<?=htmlspecialchars($appointment['id'])?>">
                
                    <label for="date">New Date:</label>
                    <input type="date" id="appointment_date" required>
                    <span class="validation-message"></span><br><br>
        
                    <label for="time">New Time:</label>
                    <input type="time" id="appointment_time" required>
                    <span class="validation-message"></span><br><br>
        
                    <button type="button" id="submit-reschedule">Reschedule</button>
                </form>
                <p id="response-message" style="color: red; font-weight: bold;"></p>
            <?php else: ?>
                <p>Appointment not found.</p>
            <?php endif; ?> 
          </td>
        </tr>
      </table>
      <script src="../../asset/js/advisor/rescheduleAppoinment.js"></script>
  </body>
</html>