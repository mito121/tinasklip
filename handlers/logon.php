<?php
require_once '../includes/dbconnect.php';

$info = json_decode(file_get_contents("php://input"));
$output = array();

if (count($info) > 0) {

    $username = mysqli_real_escape_string($dbConn, $info->username);
    $password = $info->password;

    $sql = "SELECT `id`, `username`, `password` "
            . " FROM `ng_users`"
            . " WHERE username = '$username'";
    $result = $dbConn->query($sql);
    
    if ($result->num_rows > 0) { // If email exists in database
        while ($obj = $result->fetch_object()) {// Get password from database
            $db_password = $obj->password;
        }
        if (password_verify($password, $db_password)) { // If passwords match
            $sql = "SELECT `id`, `username`, `password` "
            . " FROM `ng_users`"
            . " WHERE username = '$username'";
					
            $result = $dbConn->query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $output[] = $row;
            }
        } else { // If passwords don't match
            $output = 0;
        }
    } else { // If e-mail doesn't exist
        $output = 0;
    }
    echo json_encode($output);
}