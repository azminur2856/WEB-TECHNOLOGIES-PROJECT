<?php 
require_once('db.php');

function getConfirmedAppointments($advisor_id) {
    $con = getConnection();
    $sql = "SELECT c.*, u.username AS farmer_name 
            FROM confirmed_appointments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.advisor_id = '{$advisor_id}'";
    $result = mysqli_query($con, $sql);

    $appointments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }

    return $appointments;
}


function getFarmerNotificationCount($farmer_id) {
    $con = getConnection();
    $sql = "SELECT COUNT(*) AS notification_count 
            FROM confirmed_appointments 
            WHERE user_id = '{$farmer_id}' AND notified = 0";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['notification_count'] ?? 0;
}

// Fixed
function getConfirmedAppointmentsForFarmer($farmer_id) {
    $con = getConnection();
    $sql = "SELECT c.*, u.name AS advisor_name 
            FROM confirmed_appointments c 
            JOIN users u ON c.advisor_id = u.id 
            WHERE c.user_id = '{$farmer_id}'";
    $result = mysqli_query($con, $sql);

    $appointments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }


    $sql_update = "UPDATE confirmed_appointments SET notified = 1 WHERE user_id = '{$farmer_id}' AND notified = 0";
    mysqli_query($con, $sql_update);

    return $appointments;
}



function getFarmerAppointments() {
    $con = getConnection();
    $sql = "SELECT c.*, 
                   u.name AS farmer_name, 
                   a.name AS advisor_name 
            FROM confirmed_appointments c 
            JOIN users u ON c.user_id = u.id 
            JOIN users a ON c.advisor_id = a.id"; // Join to get advisor name
    $result = mysqli_query($con, $sql);

    $appointments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }
    return $appointments;
}

function searchFarmerAppointments($query) {
    $con = getConnection();
    $sql = "SELECT a.*, u.name AS farmer_name, adv.username AS advisor_name 
            FROM confirmed_appointments a 
            JOIN users u ON a.user_id = u.id 
            JOIN users adv ON a.advisor_id = adv.id 
            WHERE u.name LIKE '%$query%' OR adv.name LIKE '%$query%' 
                  OR a.phone_number LIKE '%$query%' OR a.service LIKE '%$query%' 
                  OR a.details LIKE '%$query%'";
    $result = mysqli_query($con, $sql);

    $appointments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }
    return $appointments;
}

?>