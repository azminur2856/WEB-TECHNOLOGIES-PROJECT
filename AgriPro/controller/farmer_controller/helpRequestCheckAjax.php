<?php
session_start();
require_once('../../model/farmerModel.php');

if (isset($_POST['mydata']) && isset($_SESSION['farmerStatus'])) {
    $data = json_decode($_POST['mydata'], true);

    if ($data) {
        $userId = $data['userId'];
        $category = $data['category'];
        $query = $data['query'];

        if (!empty($userId) && !empty($category) && !empty($query)) {
            $status = helpRequest($userId, $category, $query);
            if ($status) {
                echo json_encode(['success' => true, 'message' => 'Help Request Submitted Successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to submit help request. Please try again!']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data provided!']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid Request']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No data received']);
}