<?php
    include_once('../../controller/advisor_controller/advisorSession.php');   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Advisor Dashboard</title>
    <link rel="stylesheet" href="../../asset/css/advisor/dashboard.css">
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
                <a href="notification.php">Notification</a>
              </li>
              <li class="dashboard-item">
                <a href="search.php">Search</a>
              </li>
              <li class="dashboard-item">
                <a href="manageAppoinment.php">Manage Appoinment</a>
              </li>
              <li class="dashboard-item">
                <a href="blog.php">Blog</a>
              </li>
              <li class="dashboard-item">
                <a href="surveyFeedbackView.php">Survey Feedback</a>
              </li>
              <li class="dashboard-item">
                <a href="helpRequest.php">Help Request</a>
              </li>
              <li class="dashboard-item">
                <a href="viewHelpRequest.php">View Help Request</a>
              </li>              
              <li class="dashboard-item">
                <a href="../../controller/signout.php?msg=advisor">Sign Out</a>
              </li>
            </ul>
          </td>
        </tr>
      </table>
    </from>
  </body>
</html>
