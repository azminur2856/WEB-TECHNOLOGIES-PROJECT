<?php
require_once('../../model/user.php');
require_once('../../model/appointment.php');
require_once('../../model/confirmed_appointment.php');
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];
 
    $farmerAppointments = getFarmerAppointments();
    $farmerResults = array_filter($farmerAppointments, function ($appointment) use ($query) {
        return stripos($appointment['farmer_name'], $query) !== false ||
               stripos($appointment['advisor_name'], $query) !== false ||
               stripos($appointment['service'], $query) !== false ||
               stripos($appointment['details'], $query) !== false;
    });
 
    $farmerTable = '';
    foreach ($farmerResults as $appointment) {
        $farmerTable .= '<tr>';
        $farmerTable .= '<td>' . htmlspecialchars($appointment['advisor_name']) . '</td>';
        $farmerTable .= '<td>' . htmlspecialchars($appointment['farmer_name']) . '</td>';
        $farmerTable .= '<td>' . htmlspecialchars($appointment['phone_number']) . '</td>';
        $farmerTable .= '<td>' . htmlspecialchars($appointment['appointment_date']) . '</td>';
        $farmerTable .= '<td>' . htmlspecialchars($appointment['appointment_time']) . '</td>';
        $farmerTable .= '<td>' . htmlspecialchars($appointment['service']) . '</td>';
        $farmerTable .= '<td>' . htmlspecialchars($appointment['details']) . '</td>';
        $farmerTable .= '</tr>';
    }
 
    $advisorAppointments = getAdvisorAppointments();
    $advisorResults = array_filter($advisorAppointments, function ($appointment) use ($query) {
        return stripos($appointment['farmer_name'], $query) !== false ||
               stripos($appointment['advisor_name'], $query) !== false ||
               stripos($appointment['service'], $query) !== false ||
               stripos($appointment['details'], $query) !== false;
    });
 
    $advisorTable = '';
    foreach ($advisorResults as $appointment) {
        $advisorTable .= '<tr>';
        $advisorTable .= '<td>' . htmlspecialchars($appointment['farmer_name']) . '</td>';
        $advisorTable .= '<td>' . htmlspecialchars($appointment['advisor_name']) . '</td>';
        $advisorTable .= '<td>' . htmlspecialchars($appointment['phone_number']) . '</td>';
        $advisorTable .= '<td>' . htmlspecialchars($appointment['appointment_date']) . '</td>';
        $advisorTable .= '<td>' . htmlspecialchars($appointment['appointment_time']) . '</td>';
        $advisorTable .= '<td>' . htmlspecialchars($appointment['service']) . '</td>';
        $advisorTable .= '<td>' . htmlspecialchars($appointment['details']) . '</td>';
        $advisorTable .= '</tr>';
    }
 
    echo json_encode([
        'farmer_appointments' => $farmerTable,
        'advisor_appointments' => $advisorTable
    ]);
}
?>
 
 