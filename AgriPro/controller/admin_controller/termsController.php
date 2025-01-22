<?php
session_start();
require_once('../../model/tcModel.php');
header('Content-Type: application/json');
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
 
    if ($action === 'fetch') {
        try {
            $termsContent = getTermsAndConditions();
            echo json_encode(['status' => 'success', 'content' => $termsContent]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to fetch terms and conditions.']);
        }
    } elseif ($action === 'update') {
        $termsContent = $_POST['terms'] ?? '';
 
        if (empty(trim($termsContent))) {
            echo json_encode(['status' => 'error', 'message' => 'Terms and conditions cannot be empty.']);
            exit;
        }
 
        $con = getConnection();
        $escapedContent = mysqli_real_escape_string($con, trim($termsContent));
 
        $sql = "UPDATE terms_conditions SET content = '{$escapedContent}' WHERE id = 1";
        if (mysqli_query($con, $sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Terms and conditions updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update terms and conditions.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
 
 