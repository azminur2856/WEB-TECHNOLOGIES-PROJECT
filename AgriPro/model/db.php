<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "agripro";
    function getConnection(){
        global $dbhost;
        global $dbuser;
        global $dbpass;
        global $dbname;
        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        return $con;
    }
?>