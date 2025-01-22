<?php
session_start();
require_once('../../model/userModel.php');
require_once('../../model/user.php');
require_once('../../model/appointment.php');
require_once('../../model/confirmed_appointment.php');
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = getUserByEmail($_SESSION['farmerEmail']);

    $user_id = $user['id'];
    $advisor_id = trim($_POST['advisor_id']);
    $phone_number = trim($_POST['phone_number']);
    $appointment_date = trim($_POST['appointment_date']);
    $appointment_time = trim($_POST['appointment_time']);
    $service = trim($_POST['service']);
    $details = trim($_POST['details']);
 
    $errors = [];
 
    if (empty($advisor_id)) {
        $errors[] = "Advisor ID is required!";
    }
 
    if (empty($phone_number)) {
        $errors[] = "Phone number is required!";
    } elseif (strlen($phone_number) != 11 || substr($phone_number, 0, 2) != "01" || !is_numeric($phone_number)) {
        $errors[] = "Invalid phone number format!";
    }
 
    if (empty($appointment_date)) {
        $errors[] = "Appointment date is required!";
    } else {
        $date_parts = explode("-", $appointment_date);
        if (count($date_parts) != 3 || !checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
            $errors[] = "Invalid appointment date format. Please use YYYY-MM-DD!";
        }
    }
 
    if (empty($appointment_time)) {
        $errors[] = "Appointment time is required!";
    } else {
        $time_parts = explode(":", $appointment_time);
        if (count($time_parts) != 2 || $time_parts[0] < 0 || $time_parts[0] > 23 || $time_parts[1] < 0 || $time_parts[1] > 59) {
            $errors[] = "Invalid appointment time format. Please use HH:MM (24-hour format)!";
        }
    }
 
    if (empty($service)) {
        $errors[] = "Service is required!";
    }
 
    if (empty($details)) {
        $errors[] = "Details are required!";
    }
 
    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'messages' => $errors]);
    } else {
        $status = addAppointment($user_id, $advisor_id, $phone_number, $appointment_date, $appointment_time, $service, $details);
        if ($status) {
            echo json_encode(['status' => 'success', 'message' => 'Appointment successfully booked!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to book the appointment.']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
 
 