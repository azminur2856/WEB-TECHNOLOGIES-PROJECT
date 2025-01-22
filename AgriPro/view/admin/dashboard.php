<?php
    include_once('../../controller/admin_controller/adminSession.php');  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../asset/css/admin/dashboard.css">
  </head>
  <body>
    <from>
      <table align="left" width="30%" id="dashboard">
        <tr>
          <td>
            <ul>
              <li class="dashboard-item">
                <a href="viewDashboard.php">Dashboard</a>
              </li>
              <li class="dashboard-item">
                <a href="viewProfile.php">View Profile</a>
              </li>
              <li class="dashboard-item">
                <a href="addUpdateDelete.php">User Management</a>
              </li>
              <li class="dashboard-item">
                <a href="notification.php">Notification</a>
              </li>
              <li class="dashboard-item">
                <a href="report.php">Report</a>
              </li>
              <li class="dashboard-item">
                <a href="search.php">Search</a>
              </li>
              <li class="dashboard-item">
                <a href="paymentReport.php">Payment Report</a>
              </li>
              <li class="dashboard-item">
                <a href="viewHelpRequest.php">View Help Request</a>
              </li>
              <li class="dashboard-item">
                <a href="updateTC.php">Update T&C</a>
              </li>
              <li class="dashboard-item">
                <a href="../../controller/signout.php?msg=admin">Sign Out</a>
              </li>
            </ul>
          </td>
        </tr>
      </table>
    </from>
  </body>
</html>
