<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        include_once('../../model/confirmed_appointment.php');

        $email = $_SESSION['farmerEmail'];
        $farmer = getUserByEmail($email);
        $farmer_id = $farmer['id'];

        $notification_count = getFarmerNotificationCount($farmer_id);
    ?>
    <h3 style="text-align: center">Notification</h3>
    <hr />
    <form>
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td align="center">
            You have <span id="notificationCount"><?= $notification_count ?></span> confirmed appointment(s).
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>