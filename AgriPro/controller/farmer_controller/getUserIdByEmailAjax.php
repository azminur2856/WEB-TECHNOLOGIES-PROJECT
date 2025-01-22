<?php
session_start();
require_once('../../model/userModel.php');

if (isset($_POST['email']) && isset($_SESSION['farmerStatus'])) {
    $email = trim($_POST['email']);
    $user = getUserByEmail($email);

    if ($user) {
        echo json_encode(['success' => true, 'userId' => $user['id']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No email provided!']);
}
?>
