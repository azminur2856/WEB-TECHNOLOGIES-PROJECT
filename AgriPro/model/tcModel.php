<?php
    require_once('db.php');


    function getTermsAndConditions() {
        $con = getConnection();
        $sql = "SELECT content FROM terms_conditions WHERE id = 1";
        $result = mysqli_query($con, $sql);
    
        if (!$result) {
            throw new Exception('SQL Error: ' . mysqli_error($con));
        }
    
        $terms = mysqli_fetch_assoc($result);
        return $terms ? $terms['content'] : 'No terms and conditions available.';
    }
?>