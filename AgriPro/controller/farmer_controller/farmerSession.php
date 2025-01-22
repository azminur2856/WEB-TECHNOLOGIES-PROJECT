<?php
    session_start();
    if (!isset($_SESSION['farmerStatus'])) {
        header('location: ../../view/signin.php');
    }
?>