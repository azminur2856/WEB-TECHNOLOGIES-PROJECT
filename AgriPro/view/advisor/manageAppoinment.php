<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Advisor Dashboard</title>
    <script src="../../asset/js/advisor/manage_appointment.js"></script>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        require_once('../../model/user.php');
        require_once('../../model/appointment.php');
        require_once('../../model/confirmed_appointment.php');

        
        $user = getUserByEmail($_SESSION['advisorEmail']);
        $advisor_id = $user['id'];
        $appointments = getAppointmentsByAdvisor($advisor_id);
    ?>
    <h3 style="text-align: center">Manage Appoinment</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
              <?php if (!empty($appointments)): ?>
              <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>Farmer Name</th>
                        <th>Phone Number</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Service</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="appointments-list">
                    <?php foreach ($appointments as $appointment): ?>
                        <tr id="appointment-<?=htmlspecialchars($appointment['id'])?>">
                            <td><?=htmlspecialchars($appointment['farmer_name'])?></td>
                            <td><?=htmlspecialchars($appointment['phone_number'])?></td>
                            <td><?=htmlspecialchars($appointment['appointment_date'])?></td>
                            <td><?=htmlspecialchars($appointment['appointment_time'])?></td>
                            <td><?=htmlspecialchars($appointment['service'])?></td>
                            <td><?=htmlspecialchars($appointment['details'])?></td>
                            <td>
                                <button class="reschedule-btn" data-id="<?=htmlspecialchars($appointment['id'])?>">Reschedule</button>
                                <button class="cancel-btn" data-id="<?=htmlspecialchars($appointment['id'])?>">Cancel</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>No appointments found.</p>
            <?php endif; ?>
          </td>
        </tr>
      </table>
      <script src="../../asset/js/advisor/manage_appointment.js"></script>
  </body>
</html>