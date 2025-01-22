<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Advisor Dashboard</title>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        include_once('../../model/appointment.php');

        $email = $_SESSION['advisorEmail'];
        $advisor = getUserByEmail($email);
        $advisor_id = $advisor['id'];
        $appointment_count = getAppointmentCountByAdvisor($advisor_id);
    ?>
    <h3 style="text-align: center">Notification</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td align="center">
            You have <span id="notificationCount"><?= $appointment_count ?></span> appointment(s) pending.
          </td>
        </tr>
      </table>
  </body>
</html>