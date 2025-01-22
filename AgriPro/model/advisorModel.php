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

    // Pending Help request view function
    function getPendingHelpRequestsWithUserDetails() {
        $con = getConnection();
        $sql = "SELECT 
                    hr.id,
                    u.name,
                    u.email,
                    hr.category,
                    hr.query,
                    hr.feedback_status,
                    hr.created_at
                FROM 
                    help_requests hr
                INNER JOIN 
                    users u 
                ON 
                    hr.query_creator_id = u.id
                WHERE 
                    hr.category != 'General Support' && hr.feedback_status = 'Pending'
                ORDER BY 
                    hr.created_at DESC";
        
        $result = mysqli_query($con, $sql);
        $helpRequests = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $helpRequests[] = $row;
            }
        }

        return $helpRequests;
    }

    // Resolved Help request view function
    function getResolvedHelpRequestsWithUserDetails() {
        $con = getConnection();
        $sql = "SELECT 
                    hr.*,
                    u.name
                FROM 
                    help_requests hr
                INNER JOIN 
                    users u 
                ON 
                    hr.query_creator_id = u.id
                WHERE
                    hr.category != 'General Support' && hr.feedback_status = 'Resolved'";
        
        $result = mysqli_query($con, $sql);
        $helpRequests = [];
    
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $helpRequests[] = $row;
            }
        }
    
        return $helpRequests;
    }

    // Search help request function
    function searchHelpRequest($search) {
        $conn = getConnection();
    
        $sql = "SELECT hr.*, 
                       u.name, 
                       u.email 
                FROM help_requests hr
                INNER JOIN users u
                ON hr.query_creator_id = u.id
                WHERE (u.name LIKE '%$search%' 
                       OR u.email LIKE '%$search%'
                       OR hr.category LIKE '%$search%')
                      AND hr.feedback_status = 'Pending' 
                      AND hr.category != 'General Support'
                      ORDER BY hr.created_at DESC";
    
        $result = mysqli_query($conn, $sql);
        $helpRequests = [];
    
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $helpRequests[] = $row;
            }
        }
    
        mysqli_close($conn);
        return $helpRequests;
    }

    // Get help request by id function
    function getHelpRequestById($id) {
        $conn = getConnection();
    
        $sql = "SELECT hr.*, 
                       u.name, 
                       u.email 
                FROM help_requests hr
                INNER JOIN users u
                ON hr.query_creator_id = u.id
                WHERE hr.id = '$id'";
    
        $result = mysqli_query($conn, $sql);
        $helpRequest = [];
    
        if ($result && mysqli_num_rows($result) > 0) {
            $helpRequest = mysqli_fetch_assoc($result);
        }
    
        mysqli_close($conn);
        return $helpRequest;
    }
    
    // Update feedback in database function
    function updateFeedbackInDatabase($id, $feedbackerId, $feedback)
    {
        $con = getConnection();
        $sql = "UPDATE help_requests SET feedbacker_id = '{$feedbackerId}', feedback = '{$feedback}' WHERE id = '{$id}'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


?>