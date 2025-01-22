<?php
    include_once("dashboard.php");
    include_once('../../model/userModel.php');
    include_once('../../model/advisorModel.php');
    $email = $_SESSION['advisorEmail'];
    $user = getUserByEmail($email);
    $feedbackerId = $user['id'];
    $helpRequests = getHelpRequestById($_REQUEST['helpRequestId']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Advisor Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../asset/css/advisor/feedbackHelpRequest.css">
    <script src="../../asset/js/advisor/feedbackCheck.js"></script>
</head>
<body>
    <h3 style="text-align: center">Feedback for Help Request</h3>
    <hr />
    <form action="../../controller/advisor_controller/feedbackCheck.php" method="POST" onsubmit="return validateFeedbackForm()">
        <table align="right" id="feedbackHelpRequest" class="table-st" cellspacing="0" width="70%">
            <tr>
                <td colspan="2" align="center" class="jsError" id="errorTD" style="color: red;">
                    <?= isset($_SESSION['feedback_error']) ? $_SESSION['feedback_error'] : ''; ?>
                    <ul id="errorList">
                    </ul>
                </td>
            </tr>
            <tr>
                <td><label>Name:</label></td>
                <td><a><?= $helpRequests['name'] ?></a></td>
            </tr>
            <tr>
                <td><label>Category:</label></td>
                <td><a><?= $helpRequests['category'] ?></a></td>
            </tr>
            <tr>
                <td><label>Request At:</label></td>
                <td><a><?= $helpRequests['created_at'] ?></a></td>
            </tr>
            <tr>
                <td><label>Query:</label></td>
                <td><p><?= $helpRequests['query'] ?></p></td>
            </tr>
            <tr>
                <td><label for="feedback">Feedback:</label></td>
                <td>
                    <input type="hidden" name="helpRequestId" value="<?= $helpRequests['id'] ?>">
                    <input type="hidden" name="feedbackerId" value="<?= $feedbackerId ?>">
                    <input type="hidden" name="email" value="<?= $helpRequests['email'] ?>">
                    <textarea id="feedback" name="feedback" rows="10" cols="50" placeholder="Enter feedback....."></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>

        </table>
    </form>
    <?php
        unset($_SESSION['feedback_error']);
    ?>
</body>
</html>