<?php
session_start();
require_once('../../model/user.php');
require_once('../../model/appointment.php');
require_once('../../model/confirmed_appointment.php');

if (isset($_POST['appointment_id']) && isset($_POST['action'])) {
    $appointment_id = intval($_POST['appointment_id']);
    $action = trim($_POST['action']);
 
    if ($action === 'cancel') {
        $status = cancelAppointment($appointment_id);
        if ($status) {
            echo json_encode(["status" => "success", "message" => "Appointment canceled successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to cancel appointment."]);
        }
    } elseif ($action === 'reschedule') {
        $_SESSION['reschedule_appointment_id'] = $appointment_id;
        echo json_encode(["status" => "success", "message" => "Redirecting to reschedule page."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
 
 