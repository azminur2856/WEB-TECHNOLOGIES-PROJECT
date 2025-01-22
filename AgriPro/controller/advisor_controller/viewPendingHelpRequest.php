<?php
    session_start();
    require_once('../../model/advisorModel.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['advisorEmail'])) {
        $helpRequests = getPendingHelpRequestsWithUserDetails();
        echo json_encode($helpRequests);
        exit;
    }
    http_response_code(400);
    echo json_encode(["error" => "Invalid request."]);
?>
