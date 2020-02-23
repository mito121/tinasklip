<?php
require_once '../includes/dbconnect.php';

$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $name = mysqli_real_escape_string($dbConn, $info->name);
    $price = mysqli_real_escape_string($dbConn, $info->price);

    $sql = "INSERT INTO `ng_pricelist`(`name`, `price`) VALUES ('$name', '$price')";
    $result = $dbConn->query($sql);
    
    if($result == true){
        echo "true";
    }else{
        echo "false";
    }
}