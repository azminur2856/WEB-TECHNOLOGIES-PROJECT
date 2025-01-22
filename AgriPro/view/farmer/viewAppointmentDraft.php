<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
    <script src="../../asset/js/farmer/farmer_confirmed_appointments.js" defer></script>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        require_once('../../model/user.php');
        require_once('../../model/appointment.php');
        require_once('../../model/confirmed_appointment.php');

        $email = $_SESSION['farmerEmail'];
        $farmer = getUserByEmail($email);
        $farmer_id = $farmer['id'];
    ?>
    <h3 style="text-align: center">Your Confirmed Appointments</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
          <input type="hidden" id="farmer_id" value="<?= htmlspecialchars($farmer_id) ?>" />
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <?php
                        if (isset($_POST['mydata'])) {
                            header('Content-Type: application/json');
                         
                            $data = json_decode($_POST['mydata'], true);
                            $farmer_id = $data['farmer_id'] ?? null;
                         
                            if (!isset($_SESSION['farmerStatus'])) {
                                echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
                                exit();
                            }
                         
                            $confirmed_appointments = getConfirmedAppointmentsForFarmer($farmer_id);
                            echo json_encode(["status" => "success", "appointments" => $confirmed_appointments]);
                            exit();
                        }
                    ?>
                    <tr>
                        <th>Advisor Name</th>
                        <th>Phone Number</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Service</th>
                        <th>Details</th>
                    </tr>
                </thead>
                    <tbody id="appointments-list">
                        <tr><td colspan="6">Loading...</td></tr>
                    </tbody>
                </table>
          </td>
        </tr>
      </table>
  </body>
</html>