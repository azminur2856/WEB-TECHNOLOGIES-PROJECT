<?php
    require_once('db.php');

    // Help request function
    function helpRequest($userId, $category, $query) {
        $con = getConnection();
        $sql = "INSERT INTO help_requests (query_creator_id, category, query) VALUES ('{$userId}', '{$category}', '{$query}')";
    
        $result = mysqli_query($con, $sql);
    
        if ($result) {
            return true;
        } else {
            return false;
        }
        mysqli_close($con);
    }
?>