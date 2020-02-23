<?php
require_once '../includes/dbconnect.php';

$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $id = mysqli_real_escape_string($dbConn, $info->id);

    $sql = "DELETE FROM `ng_pricelist` WHERE id='$id'";
    
    $result = $dbConn->query($sql);
    
    if($result == true){
        echo "true";
    }else{
        echo "false";
    }
}