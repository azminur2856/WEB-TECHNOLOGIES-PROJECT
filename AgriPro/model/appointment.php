<?php 
    require_once('db.php');

// Fixed
function addAppointment($user_id, $advisor_id, $phone_number, $appointment_date, $appointment_time, $service, $details) {
    $con = getConnection();
    $sql = "INSERT INTO appointments (user_id, advisor_id, phone_number, appointment_date, appointment_time, service, details) 
            VALUES ('{$user_id}', '{$advisor_id}', '{$phone_number}', '{$appointment_date}', '{$appointment_time}', '{$service}', '{$details}')";
    return mysqli_query($con, $sql);
}

// Fixed
function getAppointmentsByAdvisor($advisor_id) {
    $con = getConnection();
    $sql = "SELECT a.*, u.name AS farmer_name 
            FROM appointments a 
            JOIN users u ON a.user_id = u.id 
            WHERE a.advisor_id = '{$advisor_id}'";
    $result = mysqli_query($con, $sql);

    $appointments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }

    return $appointments;
}

// Fixed
function cancelAppointment($appointment_id) {
    $con = getConnection();
    $sql = "DELETE FROM appointments WHERE id = '{$appointment_id}'";
    return mysqli_query($con, $sql);
}

// Fixed
function getAppointmentById($appointment_id) {
    $con = getConnection();
    $sql = "SELECT * FROM appointments WHERE id = '{$appointment_id}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

// Fixed
function rescheduleAppointment($appointment_id, $new_date, $new_time) {
    $con = getConnection();

    $sql = "SELECT * FROM appointments WHERE id = '{$appointment_id}'";
    $result = mysqli_query($con, $sql);
    $appointment = mysqli_fetch_assoc($result);

    if ($appointment) {

        $sql_insert = "INSERT INTO confirmed_appointments (id, user_id, advisor_id, phone_number, appointment_date, appointment_time, service, details, notified) 
                       VALUES ('{$appointment['id']}', '{$appointment['user_id']}', '{$appointment['advisor_id']}', '{$appointment['phone_number']}', '{$new_date}', '{$new_time}', '{$appointment['service']}', '{$appointment['details']}', 0)";
        mysqli_query($con, $sql_insert);


        $sql_delete = "DELETE FROM appointments WHERE id = '{$appointment_id}'";
        mysqli_query($con, $sql_delete);

        return true;
    }

    return false;
}

// Fixed
function getAppointmentCountByAdvisor($advisor_id) {
    $con = getConnection();
    $sql = "SELECT COUNT(*) AS appointment_count FROM appointments WHERE advisor_id = '{$advisor_id}'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['appointment_count'];
}

function getAdvisorAppointments() {
    $con = getConnection();
    $sql = "SELECT a.*, 
                   u1.name AS farmer_name, 
                   u2.name AS advisor_name 
            FROM appointments a 
            JOIN users u1 ON a.user_id = u1.id 
            JOIN users u2 ON a.advisor_id = u2.id";
    $result = mysqli_query($con, $sql);

    $appointments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }
    return $appointments;
}


// Fixed
function getAdminNotificationCount() { 
    $con = getConnection();
    
    // Count new appointments
    $sql_new_appointments = "SELECT COUNT(*) AS new_appointments 
                             FROM appointments 
                             WHERE notified_admin = 0";
    $result_new = mysqli_query($con, $sql_new_appointments);
    $row_new = mysqli_fetch_assoc($result_new);
    $new_appointments = $row_new['new_appointments'] ?? 0;

    // Count confirmed appointments
    $sql_confirmed_appointments = "SELECT COUNT(*) AS confirmed_appointments  
                                   FROM confirmed_appointments
                                   WHERE notified_admin = 0";
    $result_confirmed = mysqli_query($con, $sql_confirmed_appointments);
    $row_confirmed = mysqli_fetch_assoc($result_confirmed);
    $confirmed_appointments = $row_confirmed['confirmed_appointments'] ?? 0;

    // Return the total count
    return $new_appointments + $confirmed_appointments;
}

// Fixed
function markAdminNotificationsAsRead() {
    $con = getConnection();
    $sql_appointments = "UPDATE appointments SET notified_admin = 1 WHERE notified_admin = 0";
    mysqli_query($con, $sql_appointments);

    $sql_confirmed_appointments = "UPDATE confirmed_appointments SET notified_admin = 1 WHERE notified_admin = 0";
    mysqli_query($con, $sql_confirmed_appointments);
}

function searchAdvisorAppointments($query) {
    $con = getConnection();
    $sql = "SELECT a.*, u.username AS farmer_name, adv.username AS advisor_name 
            FROM appointments a 
            JOIN users u ON a.user_id = u.id 
            JOIN users adv ON a.advisor_id = adv.id 
            WHERE u.username LIKE '%$query%' OR adv.username LIKE '%$query%' 
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