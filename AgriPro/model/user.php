<?php
    require_once('db.php');

    function login($username, $password){
        $con = getConnection();
        $sql = "select * from users where username='{$username}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count ==1){
            return true;
        }else{
            return false;
        }
    }

    function userExists($username){
        $con = getConnection();
        $sql = "select * from users where username='{$username}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count==0){
            return false;
        }else{
            return true;
        }
    }

    function addUser($username, $email, $password, $user_type){
        $con = getConnection();
        $sql = "insert into users VALUES('', '{$username}', '{$email}', '{$password}', '{$user_type}')";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function updateUser($id, $username, $email, $password, $user_type){
        $con = getConnection();
        $sql = "update users SET username='$username', password='$password', email='$email', user_type='{$user_type}' where id='$id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function updateSelfUser($id, $username, $email, $password){
        $con = getConnection();
        $sql = "update users SET username='$username', password='$password', email='$email' where id='$id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function deleteUser($id){
        $con = getConnection();
        $sql = "DELETE FROM users where id=$id";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function getUser($id){
        $con = getConnection();
        $sql = "select * from users where id='{$id}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function getUserInfo($username){
        $con = getConnection();
        $sql = "select * from users where username='{$username}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function getAllUser(){
        $con = getConnection();
        $sql = "select * from users";
        $result = mysqli_query($con, $sql);

        $users = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($users, $row);
        }
        
        return $users;
    }
function getAdvisors() {
    $con = getConnection();
    $sql = "SELECT id, name FROM users WHERE user_type = 'Advisor'";
    $result = mysqli_query($con, $sql);

    $advisors = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $advisors[] = $row;
        }
    }

    return $advisors;
}

function userExist($username) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}

function emailExists($email) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}

function addNewUser($username, $email, $password, $account_type) {
    $con = getConnection();
    $sql = "INSERT INTO users (username, email, password, user_type) VALUES ('{$username}', '{$email}', '{$password}', '{$account_type}')";
    
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        return false;
    }
}



?>