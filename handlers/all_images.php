<?php
require_once '../includes/dbconnect.php';

$output = array();

$sql = "SELECT * FROM `ng_gallery`";

$result = mysqli_query($dbConn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    
    echo json_encode($output);
}
