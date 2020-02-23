<?php

require_once '../includes/dbconnect.php';

$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {

    $id = mysqli_real_escape_string($dbConn, $info->id);
    $target_dir = "../uploads/";
    $target_dir_small = "../uploads/small/";

    $sql = "SELECT name FROM ng_gallery WHERE id='$id'";

    $result = $dbConn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        
        while ($obj = mysqli_fetch_object($result)) {
            
            $img = $obj->name;
            
            unlink($target_dir . $img);
            unlink($target_dir_small . $img);
            
            $sql = "DELETE FROM `ng_gallery` WHERE id='$id'";
            $result = $dbConn->query($sql);
        }
    } else {
        echo "Der skete en fejl.";
    }
}