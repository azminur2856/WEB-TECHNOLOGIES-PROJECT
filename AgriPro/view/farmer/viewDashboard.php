<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="../../asset/css/farmer/viewDashboard.css">
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
        $email = $_SESSION['farmerEmail'];
        $user = getUserByEmail($email);
        if (!$user) {
            $_SESSION['data_error'] = "User not found!";
            exit;
        }
        $created_at = new DateTime($user['created_at']);
        $current_date = new DateTime();
        $membership_duration = $created_at->diff($current_date);
        $member_since = $created_at->format('F j, Y'); // e.g., "January 1, 2022"
    ?>
    <h3 style="text-align: center">Dashboard</h3>
    <hr />
    <form>
      <table align="right" id="viewDashboard" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td></td>
          <td id="errorTD" style="color: red;" colspan="2" align="center">
            <?= isset($_SESSION['data_error']) ? $_SESSION['data_error'] : ''; ?>
          </td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td align="center">
            <?php if(isset($user['profile_picture']) && !empty($user['profile_picture'])): ?>
            <img src="../../asset/image/farmer/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" style="width: 100px; height: auto;">
            <?php else: ?>
            <span>No profile picture</span>
            <?php endif; ?>
          </td>
          <td></td>
        </tr>
        <tr>
          <td colspan="3" align="center" style="color: blue;">
            <h1>Welcome Home, <?= $user['name'] ?>!</h1>
          </td>
        </tr>
        <tr>
          <td colspan="3" align="center">
            <h2>User Type: <?= $user['user_type'] ?></h2>
          </td>
        </tr>
        <tr>
          <td colspan="3" align="center">
            <h3>Member Since: <?= $member_since ?> (<?= $membership_duration->y ?> years, <?= $membership_duration->m ?> months, <?= $membership_duration->d ?> days)</h3>
          </td>
        </tr>
      </table>
      <?php
          unset($_SESSION['data_error']);
      ?>
    </form>
  </body>
</html>