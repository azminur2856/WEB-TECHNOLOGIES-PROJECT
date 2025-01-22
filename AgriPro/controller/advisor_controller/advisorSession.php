<?php
    session_start();
    if (!isset($_SESSION['advisorStatus'])) {
        header('location: ../../view/signin.php');
    }
?>