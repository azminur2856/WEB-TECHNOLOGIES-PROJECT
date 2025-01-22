<?php
    include_once("dashboard.php");
    include_once('../../model/adminModel.php');
    $helpRequests = getPendingHelpRequestsWithUserDetails();
    $sn = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../asset/css/admin/viewHelpRequest.css">
    <script src="../../asset/js/admin/viewHelpRequest.js"></script>
</head>
<body>

<h3 style="text-align: center">View Help Request</h3>
<hr />
<table align="right" id="viewHelpRequest" class="table-st" cellspacing="0" width="70%" border="1">
    <tr>
        <td colspan="7" align="center" id="errorTD" style="color: <?= isset($_SESSION['feedback_success']) ? 'green' : 'red'; ?>;">
            <?= isset($_SESSION['feedback_error']) ? $_SESSION['feedback_error'] : ''; ?>
            <?= isset($_SESSION['feedback_success']) ? $_SESSION['feedback_success'] : ''; ?>
        </td>
    </tr>
    <tr>
        <td colspan="5" align="center">
            <input type="text" id="search" name="search" placeholder="Search by Name/Email" onkeyup="searchHelpRequest()">
        </td>
        <td>
            <input type="button" id="pending" name="pending" value="Pending" onclick="viewPendingHelpRequest()">
        </td>
        <td>
            <input type="button" id="resolve" name="resolve" value="Resolved" onclick="viewResolvedHelpRequest()">
        </td>
    </tr>
    <tbody id="helpRequestTable">
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Category</th>
        <th colspan="2">Query</th>
        <th>Request At</th>
        <th>Action</th>
    </tr>
    <?php if (!empty($helpRequests)): ?>
        <?php foreach ($helpRequests as $request): ?>
        <tr>
            <td style="text-align: center"><?= $sn++ ?></td>
            <td style="text-align: center"><?= htmlspecialchars($request['name']); ?></td>
            <td style="text-align: center"><?= htmlspecialchars($request['category']); ?></td>
            <td colspan="2" style="text-align: justify;"><?= htmlspecialchars($request['query']); ?></td>
            <td style="text-align: center"><?= $request['created_at']; ?></td>
            <td style="text-align: center"><a href="feedbackHelpRequest.php?helpRequestId=<?=$request['id']?>"> Feedback </a></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <tr>
        <td colspan="7">No help requests found.</td>
    </tr>
    <?php endif; ?>
    </tbody>
</table>
<?php
    unset($_SESSION['feedback_error']);
    unset($_SESSION['feedback_success']);
?>
</body>
</html>
