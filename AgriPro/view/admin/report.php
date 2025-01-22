<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../asset/css/admin/report.css">
    <link rel="stylesheet" href="../../asset/js/admin/admin_report.js">
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        require_once('../../model/user.php');
        require_once('../../model/appointment.php');
        require_once('../../model/confirmed_appointment.php');
        $farmer_appointments = getFarmerAppointments();
        $advisor_appointments = getAdvisorAppointments();
        markAdminNotificationsAsRead();
 
    ?>
    <h3 style="text-align: center">Report</h3>
    <hr />
    <form>
      <table id="report" align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
          <h1>Admin Report</h1> 
            <!-- <input
                type="text"
                id="search"
                placeholder="Search Appointments"
                onkeyup="searchAppointments()"
            />
            <span id="search_status"></span> -->

            <h2>Farmer Appointments</h2>
            <div id="farmer_appointments_container">
                <table border="1" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Advisor Name</th>
                            <th>Farmer Name</th>
                            <th>Phone Number</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Service</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody id="farmer_appointments_table">
                        <?php foreach ($farmer_appointments as $appointment): ?>
                        <tr>
                            <td><?=htmlspecialchars($appointment['advisor_name'])?></td>
                            <td><?=htmlspecialchars($appointment['farmer_name'])?></td>
                            <td><?=htmlspecialchars($appointment['phone_number'])?></td>
                            <td><?=htmlspecialchars($appointment['appointment_date'])?></td>
                            <td><?=htmlspecialchars($appointment['appointment_time'])?></td>
                            <td><?=htmlspecialchars($appointment['service'])?></td>
                            <td><?=htmlspecialchars($appointment['details'])?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h2>Advisor Appointments</h2>
            <div id="advisor_appointments_container">
                <table border="1" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Advisor Name</th>
                            <th>Farmer Name</th>
                            <th>Phone Number</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Service</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody id="advisor_appointments_table">
                        <?php foreach ($advisor_appointments as $appointment): ?>
                        <tr>
                            <td><?=htmlspecialchars($appointment['advisor_name'])?></td>
                            <td><?=htmlspecialchars($appointment['farmer_name'])?></td>
                            <td><?=htmlspecialchars($appointment['phone_number'])?></td>
                            <td><?=htmlspecialchars($appointment['appointment_date'])?></td>
                            <td><?=htmlspecialchars($appointment['appointment_time'])?></td>
                            <td><?=htmlspecialchars($appointment['service'])?></td>
                            <td><?=htmlspecialchars($appointment['details'])?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>