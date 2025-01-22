<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        require_once('../../model/confirmed_appointment.php');


        $email = $_SESSION['farmerEmail'];
        $farmer = getUserByEmail($email);
        $farmer_id = $farmer['id'];
        $confirmed_appointments = getConfirmedAppointmentsForFarmer($farmer_id);
    ?>
    <h3 style="text-align: center">Your Confirmed Appointments</h3>
    <hr />
    <form>
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>Advisor Name</th>
                    <th>Phone Number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Service</th>
                    <th>Details</th>
                </tr>
                <?php foreach ($confirmed_appointments as $appointment): ?>
                    <tr>
                        <td><?=htmlspecialchars($appointment['advisor_name'])?></td>
                        <td><?=htmlspecialchars($appointment['phone_number'])?></td>
                        <td><?=htmlspecialchars($appointment['appointment_date'])?></td>
                        <td><?=htmlspecialchars($appointment['appointment_time'])?></td>
                        <td><?=htmlspecialchars($appointment['service'])?></td>
                        <td><?=htmlspecialchars($appointment['details'])?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>