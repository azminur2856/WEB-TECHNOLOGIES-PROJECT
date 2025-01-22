<?php
session_start();
require_once('../../model/userModel.php');
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
 
    if ($action === 'getAdvisors') {
        // Fetch all advisors
        $advisors = getAllAdvisors();
        header('Content-Type: application/json');
        echo json_encode($advisors);
        exit();
    }
 
    if (isset($_POST['advisor_id'], $_POST['amount'], $_POST['payment_method'])) {
        $farmer_id = $_SESSION['user']['id'];
        $advisor_id = $_POST['advisor_id'];
        $amount = floatval($_POST['amount']);
        $payment_method = $_POST['payment_method'];
 
        // Enforce minimum payment amount
        if ($amount < 100) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Payment amount must be at least 100.']);
            exit();
        }
 
        // Attempt to process the payment
        if (makePayment($farmer_id, $advisor_id, $amount, $payment_method)) {
            $advisor = getUser($advisor_id);
            $_SESSION['payment_success'] = [
                'amount' => $amount,
                'payment_method' => $payment_method,
                'advisor_name' => $advisor['username'],
                'date' => date("Y-m-d H:i:s"),
            ];
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit();
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Payment failed. Please try again.']);
            exit();
        }
    }
}
 
// Invalid request handling
header('Content-Type: application/json');
echo json_encode(['success' => false, 'error' => 'Invalid request']);
exit();
?>