<?php
session_start();
require_once('../../model/user.php');
require_once('../../model/appointment.php');
require_once('../../model/confirmed_appointment.php');
header('Content-Type: application/json');
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
 
    if (isset($input['appointment_id'], $input['appointment_date'], $input['appointment_time'])) {
        $appointment_id = intval($input['appointment_id']);
        $new_date = trim($input['appointment_date']);
        $new_time = trim($input['appointment_time']);
 
        $status = rescheduleAppointment($appointment_id, $new_date, $new_time);
 
        if ($status) {
            echo json_encode(["status" => "success", "message" => "Appointment rescheduled successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to reschedule appointment."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid method."]);
}
?>