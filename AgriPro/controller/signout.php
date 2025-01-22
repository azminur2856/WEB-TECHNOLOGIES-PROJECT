<?php
    session_start(); 
    if($_GET['msg']=="admin"){

        unset($_SESSION['adminStatus']);
        unset($_SESSION['adminEmail']);

        header('location: ../view/signin.php');

    } elseif($_GET['msg']=="advisor"){

        unset($_SESSION['advisorStatus']);
        unset($_SESSION['advisorEmail']);

        header('location: ../view/signin.php');

    } elseif($_GET['msg']=="farmer"){
        
        unset($_SESSION['farmerStatus']);
        unset($_SESSION['farmerEmail']);

        header('location: ../view/signin.php');
    }
?>