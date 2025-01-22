<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Dashboard</title>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        include_once('../../model/appointment.php');

        $admin_notifications = getAdminNotificationCount();
    ?>
    <h3 style="text-align: center">Notification</h3>
    <hr />
    <form>
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td align="center">
            You have <span id="notificationCount"><?= $admin_notifications ?></span> new and confirmed appointment(s) to review.
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>