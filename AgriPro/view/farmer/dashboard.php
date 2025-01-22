<?php
    include_once('../../controller/farmer_controller/farmerSession.php');   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="../../asset/css/farmer/dashboard.css">
  </head>
  <body>
    <from>
      <table align="left" id="dashboard" width="30%">
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
                <a href="surveyFeedback.php">Survey Feedback</a>
              </li>
              <li class="dashboard-item">
                <a href="takeAppoinment.php">Take Appoinment</a>
              </li>
              <li class="dashboard-item">
                <a href="viewAppointment.php">View Appointment</a>
              </li>
              <li class="dashboard-item">
                <a href="viewBlog.php">View Blog</a>
              </li>
              <li class="dashboard-item">
                <!-- <a href="viewCropDirectory.php">View Crop Directory</a> -->
                <a href="cropDirectory.html">View Crop Directory</a>
              </li>
              <li class="dashboard-item">
                <a href="payment.php">Payment</a>
              </li>
              <li class="dashboard-item">
                <a href="fertilizerInormation.php">Fertilizer Information</a>
              </li>
              <li class="dashboard-item">
                <!-- <a href="helpRequest.php">Help Request</a> -->
                 <a href="helpRequestAjax.php">Help Request</a>
              </li>              
              <li class="dashboard-item">
                <a href="../../controller/signout.php?msg=farmer">Sign Out</a>
              </li>
            </ul>
          </td>
        </tr>
      </table>
    </from>
  </body>
</html>
